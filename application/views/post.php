	<?if(isset($post)):?>
		<div class="media">
			<div class="media-body">
				<h4 class="media-heading"><?=$post['POST_NAME'];?></h4>
				<small>
					<i class="icon-calendar"></i>&nbsp;<?=$post['POST_DATE'];?>&nbsp;&nbsp;&nbsp;
					<i class="icon-asterisk"></i>&nbsp;<?=(isset($category[$post['POST_CATEGORY']]['NAME']) && isset($category[$post['POST_CATEGORY']]['CODE'])) ? '<a href="/' . $category[$post['POST_CATEGORY']]['CODE'] . '">' . $category[$post['POST_CATEGORY']]['NAME'] . '</a>' : 'Раздел не найден' ;?>&nbsp;&nbsp;&nbsp;
				</small>
				<div class="media">
					<?=$post['POST_TEXT'];?>
				</div>
				<small>
				<?if(isset($post["POST_TAGS_ARRAY"]) && is_array($post["POST_TAGS_ARRAY"])):?>
					<i class="icon-tags"></i>&nbsp;
					<?foreach ($post["POST_TAGS_ARRAY"] as $tag):?>
						<a href="/tag/<?=$tag?>"><?=$tag?></a>&nbsp;
					<?endforeach;?>
				<?elseif(isset($post["POST_TAGS"]) && strlen($post["POST_TAGS"]) > 0):?>
					<i class="icon-tag"></i>&nbsp;<a href="/tag/<?=$post["POST_TAGS"]?>"><?=$post["POST_TAGS"]?></a>&nbsp;
				<?endif;?>&nbsp;&nbsp;
				<i class="icon-eye-open right"></i>&nbsp;<?=$post['POST_VIEW'];?>
				</small>
			</div>
		</div>
	<?endif;?>