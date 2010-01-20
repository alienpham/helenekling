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


namespace PhotoGallery
{
    public partial class ImageThumb : UserControl
    {
        Page p;
        
        Photo ph;
        public ImageThumb()
        {
            InitializeComponent();
        }
        public ImageThumb(Page p, Photo ph)
        {
            InitializeComponent();
            this.p = p;
            thumbnail.DataContext = ph;
            this.ph = ph;
        }

        private void change_image(object sender, MouseButtonEventArgs e)
        {
                p.setPhoto(ph);
        }
       
    }
}
