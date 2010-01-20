
    <!-- left column, contains navigation and photos -->
    <div id="column1">
      <div id="nav">
        <ul>
          <li>
            <li><a href="#" accesskey="a">Catégories</a></li>
            <li>
               <ul>
					<li><a href="{jurl 'index'}">{@menu.index@}</a></li>
					<li><a href="{jurl 'jPicasa~index'}">{@menu.paintings@}<b style="color:red"> {@menu.new@} </b></a></li>
					<li><a href="{jurl 'viewPage' , array('page'=>'school')}">{@menu.school@}</a></li>
					<!-- <li><a href="{jurl 'viewPage' , array('page'=>'expo')}">{@menu.expo@}</a></li> !-->
					<li><a href="{jurl 'events~events:index'}">{@menu.events@}</a></li>
					<li><a href="{jurl 'NewsLetter~emails:precreate'}">{@menu.keep.update@}<b style="color:red"> {@menu.new@} </b></a></li>
					<li><a href="{jurl 'viewPage' , array('page'=>'contacts')}">{@menu.contacts@}</a></li>
					{ifnotconnected}<li><a href="{jurl 'login'}">{@menu.login@}</a></li>{/ifnotconnected}
               </ul>
            </li>
            {ifconnected}
            <li><a href="#" accesskey="a">Administration</a></li>
            <li>
               <ul>
					<li><a href="{jurl 'NewsLetter~default:index'}">{@menu.newsletter@}</a></li>
               		<li><a href="{jurl 'events~files:index'}">{@menu.files@}</a></li>
               
               </ul>
            </li>
            {/ifconnected}
            
	     </ul>
	     <div style="padding-left : 50%; padding-top: 20px;">
			<a href="{jurl 'index' ,array('lang'=>'fr_FR')}" hreflang="fr" ></a>
	     	<a href="{jurl 'index' ,array('lang'=>'en_US')}" hreflang="en" ></a>
	     </div>		     
      </div>
    </div>

    