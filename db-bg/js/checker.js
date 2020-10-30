(function(){
		var modal = document.getElementById("myModal");
		var span = document.getElementsByClassName("close")[0];
		var enabledEl = document.getElementById('adb-enabled');
		var disabledEl = document.getElementById('adb-not-enabled');
span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}	
		function adBlockDetected() 
		{
		document.getElementById('myModal').style.display='block';
			disabledEl.style.display = 'none';
		}
		function adBlockNotDetected() 
		{
			disabledEl.style.display = 'block';
			document.getElementById('myModal').style.display='none'
		}	
		if(typeof window.adblockDetector === 'undefined') 
		{
			adBlockDetected();
		} else {
			window.adblockDetector.init(
				{
					debug: true,
					found: function()
					{
						document.getElementById('myModal').style.display='block'
					},
					notFound: function()
					{
						adBlockNotDetected();
					}
				}
			);
		}
	}());