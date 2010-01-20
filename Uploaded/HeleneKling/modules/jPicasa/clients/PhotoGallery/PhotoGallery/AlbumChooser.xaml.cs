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

namespace PhotoGallery
{
    public partial class AlbumChooser : UserControl
    {

        private Page p;
        private Boolean controls = false;
        public AlbumChooser()
        {
            InitializeComponent();
           
            foreach (UIElement c in LayoutRoot.Children){
                c.Opacity = 0;
            }
            albumChooserPlus.Opacity = 100;

            for (int i = 2; i <= 10; i++) 
            {
                timeInterval.Items.Add(i.ToString());
            }
            timeInterval.SelectedIndex = 0;


                albums.Items.Add("All");
            albums.SelectedIndex = 0;
            Application.Current.Host.Content.FullScreenChanged += new EventHandler(FullScreenChanged);
        }
        void FullScreenChanged(object sender, EventArgs e)
        {
            if (Application.Current.Host.Content.IsFullScreen)
            {
                ToFullScreen.Content = "Back To Normall Size";
            }
            else
            {
                ToFullScreen.Content = "Switch To Full Screen";
            }
        }
        private void album_choosed(object sender, SelectionChangedEventArgs e)
        {
            if (p != null)
                p.setCurrentAlbum(albums.SelectedItem.ToString());
        }
        public Page MainPage {
            set
            {
                p = value;
            }
        }

        private void ShowHideAlbumChooser(object sender, MouseButtonEventArgs e)
        {
            if (controls)
            {
                stbHideAlbumChooser.Begin();
                albumChooserPlus.rotate();
                controls = false;
            }
            else
            {
                stbShowAlbumChooser.Begin();
                albumChooserPlus.rotate();
                controls = true;
            }
        }

        private void GoFullScreen(object sender, RoutedEventArgs e)
        {
            if (!Application.Current.Host.Content.IsFullScreen)
            {
                //p.toFullScreen(sender, e);
                Application.Current.Host.Content.IsFullScreen = true;
                ToFullScreen.Content = "Back To Normall Size";
            }
            else
            {
                Application.Current.Host.Content.IsFullScreen = false;
                ToFullScreen.Content = "Switch To Full Screen";
            }
            
        }

        private void TimeIntervalChoosed(object sender, SelectionChangedEventArgs e)
        {
            if(p != null)
                p.TimeInterval = int.Parse(timeInterval.SelectedItem.ToString());
        }
    }
}
