using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Shapes;
using System.Windows.Media.Imaging;
using PhotoGallery.Classes;
using System.Xml.Linq;

namespace PhotoGallery
{
    public partial class Page : UserControl
    {

        public static String ALBUMS_URL = "http://helenekling.com/index.php/jPicasa/default/albums";
        public static String IMAGES_URL = "http://helenekling.com/index.php/jPicasa/default/images?albumid=" ;

        double mInitialWidth = 0;
        double mInitialHeight = 0;
        public int timeInterval = 2;
        Brush lastNextFill;
        Brush lastBackFill;
        Brush lastPlayFill;
        Brush lastPauseFill;
        Boolean mouseOnControl = false;
        EventHandler eventHandler;
        System.Windows.Threading.DispatcherTimer myDispatcherTimer;
        System.Windows.Threading.DispatcherTimer slideShowTimer;
      
        IDictionary<String,Album> albums = new Dictionary<String,Album>();
        
        public Page()
        {
            InitializeComponent();

            albChooser.MainPage = this;
            
            mInitialWidth = this.Width;
            mInitialHeight = this.Height;
            
            grille.Children.Remove(pause1);
            grille.Children.Remove(pause2);


            

            Application.Current.Host.Content.FullScreenChanged += new EventHandler(Content_FullScreenChanged);

            
            WebClient xmlfile = new WebClient();
            xmlfile.DownloadStringCompleted += new DownloadStringCompletedEventHandler(xml_parse);
            xmlfile.DownloadStringAsync(new Uri(Page.ALBUMS_URL));

            

            next.Opacity = 0;
            back.Opacity = 0;
            play.Opacity = 0;
            

            grille.MouseMove += new MouseEventHandler(grille_MouseMoved);
            eventHandler = new EventHandler(timer_Tick);
            myDispatcherTimer = new System.Windows.Threading.DispatcherTimer();
            myDispatcherTimer.Interval = new TimeSpan(0, 0, 0, 0, 2500);
            myDispatcherTimer.Tick += eventHandler;
            myDispatcherTimer.Start();

            slideShowTimer = new System.Windows.Threading.DispatcherTimer();
            slideShowTimer.Interval = new TimeSpan(0, 0, 0, timeInterval, 0);
            slideShowTimer.Tick += new EventHandler(NextPicture_Tick);




            mainImage.Width = 10000;
            Photo p = new Photo(this);
           
            mainImage.DataContext = p;

            
        }
       
        private void grille_MouseMoved(object sender, System.Windows.Input.MouseEventArgs e)
        {
            next.Opacity = 100;
            back.Opacity = 100;
            
        }
        private void mainImage_MouseMove(object sender, MouseEventArgs e)
        {
            play.Opacity = 100;
            pause1.Opacity = 100;
            pause2.Opacity = 100;
        }
        public void timer_Tick(object o, EventArgs sender)
        {
            if (!mouseOnControl)
            {
                next.Opacity = 0;
                back.Opacity = 0;
                play.Opacity = 0;
                pause1.Opacity = 0;
                pause2.Opacity = 0;
            }
            
        }
        public void NextPicture_Tick(object o, EventArgs sender)
        {
            next_Picture(null,null);
        }

        public void toFullScreen(object sender, RoutedEventArgs e)
        {
            Application.Current.Host.Content.IsFullScreen = true;
        }
        void Content_FullScreenChanged(object sender, EventArgs e)
        {
            double currentWidth = Application.Current.Host.Content.ActualWidth;
            double currentHeight = Application.Current.Host.Content.ActualHeight;

            double minRatio = Math.Min((currentWidth / mInitialWidth), (currentHeight / mInitialHeight));
            grille.Width = currentWidth;
            grille.Height = currentHeight;
            setPicture(index);           
        }

        private void back_MouseEnter(object sender, MouseEventArgs e)
        {
            lastBackFill = next.Fill;
            back.Fill = new SolidColorBrush(Colors.White);
            mouseOnControl = true;
        }
        private void back_MouseLeaved(object sender, System.Windows.Input.MouseEventArgs e)
        {
            back.Fill = lastBackFill;
            mouseOnControl = false;
        }
        private void next_MouseEntered(object sender, System.Windows.Input.MouseEventArgs e)
        {
            lastNextFill = next.Fill;
            next.Fill = new SolidColorBrush(Colors.White);
            mouseOnControl = true;

        }
        private void next_MouseLeaved(object sender, System.Windows.Input.MouseEventArgs e)
        {
            next.Fill = lastNextFill;
            mouseOnControl = false;
        }
        private void play_MouseEntered(object sender, MouseEventArgs e)
        {
            lastPlayFill = play.Fill;
            play.Fill = new SolidColorBrush(Colors.White);
            mouseOnControl = true;
        }

        private void play_MouseLeaved(object sender, MouseEventArgs e)
        {
            play.Fill = lastPlayFill;
            mouseOnControl = false;
        }
        private void pause_MouseEntered(object sender, MouseEventArgs e)
        {
            lastPauseFill = pause1.Fill;
            pause1.Fill = pause2.Fill = new SolidColorBrush(Colors.White);
            mouseOnControl = true;
        }

        private void pause_MouseLeaved(object sender, MouseEventArgs e)
        {
            pause1.Fill = pause2.Fill= lastPauseFill;
            mouseOnControl = false;
        }
        private void play_Picture(object sender, MouseButtonEventArgs e)
        {
            slideShowTimer.Start();
            grille.Children.Remove(play);
            grille.Children.Add(pause1);
            grille.Children.Add(pause2);
            play.Fill = lastPlayFill;
            mouseOnControl = false;
        }

        private void setPicture(int i)
        {
            if (i <= displayedImages().Count - 1 && i >= 0)
            {
                Photo p = displayedImages().ElementAt(i);
                Double height = Double.Parse(p.Height);
                Double width = Double.Parse(p.Width);
                
                double appWidth = Application.Current.Host.Content.ActualWidth;
                double appHeight = Application.Current.Host.Content.ActualHeight;
                grille.Width = appWidth;
                grille.Height = appHeight;

                if (width > height)
                {
                    if ((appWidth * height / width) > appHeight)
                    {
                        mainImage.Height = appHeight;
                        mainImage.Width = (appHeight * width / height);
                    }
                    else
                    {
                        mainImage.Height = (appWidth * height / width);
                        mainImage.Width = appWidth;
                    }
                }
                else
                {
                    if ((width * appHeight / height) > appWidth)
                    {
                        mainImage.Width = appWidth;
                        mainImage.Height = appWidth * height / width;
                    }
                    else
                    {
                        mainImage.Width = (width * appHeight / height);
                        mainImage.Height = appHeight;
                    }    
                }
 

                mainImage.DataContext = p;
                

                index = i;
                photoInfo.setName(p.Name);
                photoInfo.setPrice(p.Price);
                photoInfo.setSize(p.Size);
            }
        }
        int index = 0;
        private void back_Picture(object sender, MouseButtonEventArgs e)
        {
            index--;
            if ( index < 0)
            {
                index = displayedImages().Count-1;
            }
            setPicture(index);
           
        }
        String currentAlbum;
        public List<Photo> displayedImages()
        {
            List<Photo> images = new List<Photo>();
            if (currentAlbum == "All")
            {
                foreach (Album a in albums.Values)
                    images.AddRange(a.Images);
            }
            else
            {
                Album a;
                albums.TryGetValue(currentAlbum, out a);
                images.AddRange(a.Images);
            }
            return images;
        }
        private void next_Picture(object sender, MouseButtonEventArgs e)
        {
            index++;
            if (displayedImages().Count <= index)
            {
                index = 0;
            }
            setPicture(index); 
        }
        void xml_parse(object sender, DownloadStringCompletedEventArgs e)
        {
            XElement xml = XElement.Parse(e.Result);
            var mes_albums = from p in xml.Elements("album") select p;
            foreach (XElement alb in mes_albums)
            {
                Album p = new Album(alb, this);
                albums.Add(alb.Element("name").Value, p);
                albChooser.albums.Items.Add(alb.Element("name").Value);

                foreach (Photo ph in p.Images)
                {
                    ImageThumb thumb = new ImageThumb(this, ph);
                    list.Children.Add(thumb);
                }
            }
            List<Photo> phs = albums.First().Value.Images;
            if (phs.Count > 0)
            {
                mainImage.DataContext = phs.First();
               
            }
            currentAlbum = "All";

            mainImage.Height = Application.Current.Host.Content.ActualHeight;
            mainImage.Width = Application.Current.Host.Content.ActualWidth;
            index = 0;
        }

        public void setPhoto(Photo ph)
        {
           
            int i = displayedImages().IndexOf(ph);
            setPicture(i);
        }
        Boolean thChooser = false;

        private void show_hide_ThumbnailChooser(object sender, MouseButtonEventArgs e)
        {

            if (!thChooser)
            {
                thumbnailChooser.Opacity = 100;
                thChooser = true;
                ((Plus)sender).rotate();
                stbShowThChooser.Begin();
            }
            else
            {
                thChooser = false;
                ((Plus)sender).rotate();
                stbHideThChooser.Begin();
            }
        }

        private void pause_Picture(object sender, MouseButtonEventArgs e)
        {
            slideShowTimer.Stop();
            grille.Children.Remove(pause1);
            pause1.Fill = lastPauseFill;
            pause2.Fill = lastPauseFill;
            grille.Children.Remove(pause2);
            grille.Children.Add(play);
            mouseOnControl = false;
        }
        public void setCurrentAlbum(String albName)
        {
            list.Children.Clear();
            currentAlbum = albName;
            foreach (Photo ph in displayedImages())
            {
                ImageThumb thumb = new ImageThumb(this, ph);
                list.Children.Add(thumb);
            }
            List<Photo> phs = displayedImages();
            if (phs.Count > 0)
            {
                mainImage.DataContext = phs.First();
                setPicture(0);
            }
            index = 0;
                
        }
        public void refresh(Album a) {
                setCurrentAlbum(currentAlbum);
        }
        public int TimeInterval 
        {
            get { return timeInterval; }
            set { 
                timeInterval = value;
                slideShowTimer.Interval = new TimeSpan(0, 0, 0, timeInterval, 0);
            }
        }   
    }
}
