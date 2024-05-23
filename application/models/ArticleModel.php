<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ArticleModel extends CI_Model
{
    public function create($title, $content, $imagePath = null)
    {
        $data = array(
            'title' => $title,
            'content' => $content,
            'image' => $imagePath
        );

        return $this->db->insert('blog', $data);
    }

    public function getArticles()
    {

        $query = $this->db->get('blog');
        return $query->result();
    }

    public function deleteArticle($id)
    {

        $this->db->where('sno', $id);
        return $this->db->delete('blog');
    }

    public function update($id, $title, $content)
    {

        $data = array(
            'title' => $title,
            'content' => $content
        );

        $this->db->where('sno', $id);
        return $this->db->update('blog', $data);
    }
}
