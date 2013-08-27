<html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="/resources/demos/style.css" />
<link href="http://glyphicons.getbootstrap.com/css/bootstrap-glyphicons.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="//code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	#blender-content{
		padding: 20px
	}
	#blender-content .row{cursor: move; background: #FFF}
	#blender-content .remove, #add-position{cursor: pointer}
	.position{
		border: 2px dashed #CCC;
		margin-bottom: 10px;
		padding: 20px;
		text-align: center;
	}
	.content{
		width: 940px;
		margin: 0 auto
	}
	.align-center{text-align:center}
	.bender-wrap{width: 940px}
</style>
</head>
<body>
<?php require 'topbar.php'; ?>
<div class="content">
<div class="row align-center">
	<img src="<?php echo JUri::base(); ?>templates/bender/framework/img/blender.png" />
	<p class="lead">Make by Bender Framework</p>
	<button id="save-order">Save State</button>
</div>

<script>
	var benderRequest = '<?php echo JUri::base(); ?>templates/bender/framework/request.php';
</script>
<hr />

<div class="row">
	<div id="blender-content">
	
		<?php 
			$blocks = new benderRender();
			echo $blocks->renderPositions(); 
		?>
		
	</div>
	<div class="row" id="add-position">
			<div class="panel align-center">
				+ Add new Position
			</div>
		</div>
</div>
<script>
	$(function(){
		// Add position to theme
		$('#add-position').click(function(){
			var positionName = prompt('Write a name to the new position');
			
			if(positionName.trim() !== ''){
				$.post(benderRequest + '?element=position&action=add',
				{ name: positionName }, function(data)
				{	
					$('#blender-content').append(data);
					atualizar();
				});
			}
		});
		
		// Remove position
		function atualizar(){
			$('.remove').click(function(){
				//var confirm = confirm('You want delete the position? Sure?');
				var divrow = $(this).parent().parent().parent();

				$.post(benderRequest + '?element=position&action=rm', {
					name: divrow.attr('data-name')
				}, function(x){
					divrow.remove();
				});
			});
		}
		atualizar();
		 $( "#blender-content" ).sortable();
		 $( "#blender-content" ).disableSelection();
		 
		 // Save order
		 $('#save-order').click(function(){
		 	var count = 1;
		 	$('#blender-content .row').each(function(){
		 		$.post(benderRequest + '?element=position&action=update', {
					name: $(this).attr('data-name'),
					order: count
				});
				count++;
		 	});
		 });
	});
	
	atualizar();
</script>
</div>
	
</body>
</html>
<?php exit; ?>