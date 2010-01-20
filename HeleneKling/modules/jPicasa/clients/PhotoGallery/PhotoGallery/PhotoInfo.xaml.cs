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
    public partial class PhotoInfo : UserControl
    {

        public PhotoInfo()
        {
            InitializeComponent();
            name.Text = "Nom";
            price.Text = "Price";
            size.Text = "260x123";
            foreach (UIElement u in LayoutRoot.Children)
                u.Opacity = 0;
            plus.Opacity = 100;

           
        }
        Boolean hidden = true;
        private void show_hide_infos(object sender, MouseButtonEventArgs e)
        {
     
            if (!hidden)
            {
                stbHide.Begin();
                plus.rotate();         
                hidden = true;
            }
            else {
                stbShow.Begin();
                plus.rotate();
                hidden = false;
               

            }
        }
        public void setName(String name)
        {
            this.name.Text = name;
        }
        public void setPrice(String price)
        {
            this.price.Text = price;
        }
        public void setSize(String size)
        {
            this.size.Text = size;
        }
    }
}
