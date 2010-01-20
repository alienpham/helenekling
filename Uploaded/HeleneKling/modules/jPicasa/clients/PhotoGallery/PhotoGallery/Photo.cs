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
using System.Xml.Linq;
using System.ComponentModel;

namespace PhotoGallery
{
    namespace Classes
    {

        public class Photo : INotifyPropertyChanged 
        {

            public String Name;
            public String Price;
            public String Size;
            public String Height;
            public String Width;
            private BitmapImage image;
            public event PropertyChangedEventHandler PropertyChanged;
            Page p;
            public Photo(XElement img, Page p)
            {
                WebClient client = new WebClient();
                client.OpenReadCompleted += new OpenReadCompletedEventHandler(client_OpenReadCompleted);
                String url = img.Element("url").Value; 
                client.OpenReadAsync(new Uri(url));
                
                
                String name = img.Element("name").Value;
                String [] infos = name.Split('@');
                Name = infos[0];
                Price = "price";
                Size = "size";
               
                if(infos.Length > 1)
                    Price = infos[1];
                if(infos.Length > 2)   
                    Size = infos[2];
                Height = img.Element("height").Value;
                Width = img.Element("width").Value;
                this.p = p;
            }

            public Photo(Page p)
            {
                this.p = p;
                image = new BitmapImage(new Uri("img.jpg", UriKind.Relative));
                Name = "Test";
                Price = "Test";
                Size = "Test";
            }

            void client_OpenReadCompleted(object sender, OpenReadCompletedEventArgs e)
            {
                BitmapImage img = new BitmapImage();
                try
                {
                    img.SetSource(e.Result);
                    Image = img;
                }
                catch (Exception exc)
                {
                }
            }
            public BitmapImage Image
            {
                get 
                {
                    return image;
                }
                set 
                {
                    image = value;
                    if (PropertyChanged != null)
                    {
                        PropertyChanged(this, new PropertyChangedEventArgs("Image"));
                    }
                }
            }

        }
    }
}
