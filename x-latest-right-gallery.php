<?

widget_css();

$_bo_table = $widget_config['forum1'];
if ( empty($_bo_table) ) $_bo_table = $widget_config['default_forum_id'];

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>

<div class='latest-right-gallery'>
	
	<?
	if ( $list ) {
		$_wr_id = $list[0]['wr_id'];
		$imgsrc = x::post_thumbnail($_bo_table, $_wr_id, 233, 368);
		$img = $imgsrc['src'];
		if ( empty($img) ) {
			$_wr_content = db::result("SELECT wr_content FROM $g5[write_prefix]$_bo_table WHERE wr_id='$_wr_id'");
			$image_from_tag = g::thumbnail_from_image_tag( $_wr_content, $_bo_table, 233, 368 );
			$img = $image_from_tag;
			if ( empty($img) ) $img = $widget_config['url']."/img/no_image.png";
		}
	} else $img = $widget_config['url']."/img/default_banner.png";
	?>
	
	<div class='right-post' style="background: url('<?=$img?>')">
		<div class='right-posts-container'>
			<? if ( $list ) {
					$url = $list[0]['url'];
					$subject = $list[0]['wr_subject'];
					$content = cut_str($list[0]['wr_content'], 80, '...');
			}
			else {
				$url = "javascript:void(0);";
				$subject = "회원님께서는 현재";
				$content = "필고 갤러리 테마 No.2를 선택 하셨습니다.";
			}
			?>
			<div class='right-posts-subject'><?=$subject?></div>
			<div class='right-posts-content'><?=$content?></div>
			<? if ( $list ) {?>자세히<a href="<?=$url?>" class='read_more'></a>
			<?} else {?> 사이트 설정<a href='<?=url_site_config()?>' class='read_more'></a><?}?>
		</div>		
	</div>
</div>