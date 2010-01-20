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
    public partial class Plus : UserControl
    {
        Boolean rotated = false;
        public Plus()
        {
            InitializeComponent();
        }
        public void rotate()
        {
            RotateTransform rt = new RotateTransform();
            RotateTransform rt2 = new RotateTransform();
           
            if (!rotated)
            {
                cross1RotateToX.Begin();
                cross2RotateToX.Begin();
                rt.Angle = 180+45;
                rt.CenterX = 1.5;
                rt.CenterY = 8;
                rt2.Angle = 180+45;
                rt2.CenterX = 8;
                rt2.CenterY = 1.5;
                rotated = true;
            }
            else
            {
                cross1RotateToPlus.Begin();
                cross2RotateToPlus.Begin();
                rt.Angle = 0;
                rt2.Angle = 0;
                rotated = false;
            }                
            //cross1.RenderTransform = rt;
           

           // cross2.RenderTransform = rt2;

            
        }
    }
   
}
