
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
    public class Album
    {
        Page page;
        List<Photo> images = new List<Photo>();

        public Album(XElement alb, Page p)
        {
            WebClient xmlfile = new WebClient();
            xmlfile.DownloadStringCompleted += new DownloadStringCompletedEventHandler(xml_parse);
            xmlfile.DownloadStringAsync(new Uri(Page.IMAGES_URL + alb.Element("id").Value));
            this.page = p;

        }
        public List<Photo> Images
        {
            get
            { return images; }
            set
            {
                images = value;
            }
        }
        void xml_parse(object sender, DownloadStringCompletedEventArgs e)
        {
            XElement xml = XElement.Parse(e.Result);
            var mes_images = from p in xml.Elements("image") select p;

            foreach (XElement img in mes_images)
            {
                Photo ph = new Photo(img, this.page);
                images.Add(ph);
            }
            page.refresh(this);
        }
    }
}
