$(document).ready(function(){
	/*$('#social').share({
        networks: ['facebook','twitter'],
        urlToShare : 'http://localhost/jadidac/'
   	});*/
   	$('#commencer').click(function(e){
   		e.preventDefault();
   		fb_login();
   	});

   	$('#partager').click(function(e){
   		e.preventDefault();
   		partageImage();
   	});
   	
   	
   	$('#inviter').click(function(e){
   		e.preventDefault();
   		inviteFriends();
   	});

   	$('.jaime-button').click(function(e){
   		e.preventDefault();
   		var id_image = $(this).data('idimage');
   		addVoteFb(id_image, jQuery(this));
   	});

   	UIkit.on('showitem.uk.lightbox', function (event, data) {
   		console.log(data);
   		var nb = $(data.item.link.context).data('nbimage');
   		var idimage = $(data.item.link.context).data('idimage');
   		var foulen = $(data.item.link.context).data('nom');
   		var url = data.source;
   		$('#jaime').attr('data-idimage',idimage);
   		$('#jaime span').html(nb);
   		$('#foulen').html(foulen);
   		$('.partager-fb').attr('data-nom',foulen);
   		$('.partager-fb').attr('data-url',url);
   	});
   	/*$('.prettyclick').click(function(){
   		var nb = $(this).data('nbimage');
   		console.log(nb);
   		$('#jaime span').html(nb);
   	});*/

});   


function randomize(num){
	var number = 1 + Math.floor(Math.random() * num);
	return number;
}
