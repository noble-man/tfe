$(document).ready(function() {
    $("sidenav li a").each(function() {
    if (this.href == window.location.href) {
        $(this).addClass("active");
        }
    });
});

/*
$(document).ready(function() {
	$("sidenav li").click(function() {
		$("sidenav li a.active").removeClass("active"); //Remove any "active" class  
		$("a", this).addClass("active"); //Add "active" class to selected tab  

		$(activeTab).show(); //Fade in the active content  
		return false;
	}
}*/