#pragma checksum "C:\Users\zoolonly\Documents\Visual Studio 2008\Projects\PhotoGallery\PhotoGallery\PhotoInfo.xaml" "{406ea660-64cf-4c82-b6f0-42d48172a799}" "77B1C19A5E909EEFA375EF45D068C6C5"
//------------------------------------------------------------------------------
// <auto-generated>
//     This code was generated by a tool.
//     Runtime Version:2.0.50727.3053
//
//     Changes to this file may cause incorrect behavior and will be lost if
//     the code is regenerated.
// </auto-generated>
//------------------------------------------------------------------------------

using PhotoGallery;
using System;
using System.Windows;
using System.Windows.Automation;
using System.Windows.Automation.Peers;
using System.Windows.Automation.Provider;
using System.Windows.Controls;
using System.Windows.Controls.Primitives;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Ink;
using System.Windows.Input;
using System.Windows.Interop;
using System.Windows.Markup;
using System.Windows.Media;
using System.Windows.Media.Animation;
using System.Windows.Media.Imaging;
using System.Windows.Resources;
using System.Windows.Shapes;
using System.Windows.Threading;


namespace PhotoGallery {
    
    
    public partial class PhotoInfo : System.Windows.Controls.UserControl {
        
        internal System.Windows.Media.Animation.Storyboard Storyboard12;
        
        internal System.Windows.Media.Animation.Storyboard stbHide;
        
        internal System.Windows.Media.Animation.Storyboard stbShow;
        
        internal System.Windows.Controls.Grid LayoutRoot;
        
        internal System.Windows.Shapes.Rectangle rectangle;
        
        internal System.Windows.Controls.TextBlock name;
        
        internal System.Windows.Controls.TextBlock price;
        
        internal System.Windows.Controls.TextBlock size;
        
        internal PhotoGallery.Plus plus;
        
        internal System.Windows.Media.Animation.Storyboard stbTranslatePlusShow;
        
        internal System.Windows.Media.Animation.Storyboard stbTranslatePlusHide;
        
        private bool _contentLoaded;
        
        /// <summary>
        /// InitializeComponent
        /// </summary>
        [System.Diagnostics.DebuggerNonUserCodeAttribute()]
        public void InitializeComponent() {
            if (_contentLoaded) {
                return;
            }
            _contentLoaded = true;
            System.Windows.Application.LoadComponent(this, new System.Uri("/PhotoGallery;component/PhotoInfo.xaml", System.UriKind.Relative));
            this.Storyboard12 = ((System.Windows.Media.Animation.Storyboard)(this.FindName("Storyboard12")));
            this.stbHide = ((System.Windows.Media.Animation.Storyboard)(this.FindName("stbHide")));
            this.stbShow = ((System.Windows.Media.Animation.Storyboard)(this.FindName("stbShow")));
            this.LayoutRoot = ((System.Windows.Controls.Grid)(this.FindName("LayoutRoot")));
            this.rectangle = ((System.Windows.Shapes.Rectangle)(this.FindName("rectangle")));
            this.name = ((System.Windows.Controls.TextBlock)(this.FindName("name")));
            this.price = ((System.Windows.Controls.TextBlock)(this.FindName("price")));
            this.size = ((System.Windows.Controls.TextBlock)(this.FindName("size")));
            this.plus = ((PhotoGallery.Plus)(this.FindName("plus")));
            this.stbTranslatePlusShow = ((System.Windows.Media.Animation.Storyboard)(this.FindName("stbTranslatePlusShow")));
            this.stbTranslatePlusHide = ((System.Windows.Media.Animation.Storyboard)(this.FindName("stbTranslatePlusHide")));
        }
    }
}
