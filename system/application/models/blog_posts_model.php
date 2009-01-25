<?php

class Blog_posts_model extends Model {

	function Blog_posts_model(){
		parent::Model();
	}
	//-------------------
	function getPostDetail($id=null){
		$w=($id) ? 'where ID='.$id : '';
		$sql=sprintf('
			select
				bp.title,
				bp.content,
				bp.date_posted,
				bp.author_id,
				bp.ID,
				(select count(ID) from blog_comments where blog_post_id=bp.ID) comment_count
			from
				blog_posts bp
			%s
			order by
				bp.date_posted desc
		',$w);
		
		$q=$this->db->query($sql);
		return $q->result();
	}
}

?>