<?php
class ImageConverter{
    private $dom;
    private $isImgBefore;
    private $imgNodes;
    private $firstImg;

    public function __construct(){
        $this->dom = new DOMDocument('1.0','UTF-8');
        $this->isImgBefore = false;
        $this->imgNodes = [];
        $this->firstImg = null;
    }

    private function traverseDom(&$dom, $node, &$isImgBefore, &$imgNodes, &$firstImg) {
        if ($node->nodeName === "#text"){
            if (!empty(trim($node->textContent))) {
                
                if ($isImgBefore && (count($imgNodes)>1)){      
                   
                    foreach ($imgNodes as $imgNode){ 
                        $imgUrls[] = $imgNode->getAttribute('src');
                    } 
                    $imgUrlsNode = $dom->createTextNode('["' . implode('", "', $imgUrls) . '"]');
                    $firstImg->parentNode->insertBefore($imgUrlsNode, $firstImg);
    
                    $imgUrls=[];
                    foreach ($imgNodes as $imgNode){ 
                        $this->delNode($imgNode); 
                    }
                }
                $isImgBefore = false;
                $imgNodes = [];
            }
        }
        if ($node->nodeType === XML_ELEMENT_NODE && $node->nodeName === 'img') {
            $imgNodes[] =  $node;
            if(!$isImgBefore){
                $firstImg = $node;
            } 
            $isImgBefore = true;        
        }
        foreach ($node->childNodes as $child) {
            $this->traverseDom($dom, $child, $isImgBefore, $imgNodes, $firstImg);
        }
    }
    
    private function delNode($node){
        if($node->parentNode)
            $node->parentNode->removeChild($node);
    }
    
    private function removingEmptyTags(&$dom){
        $exceptionsTags = array('area','base','br','col','embed','hr','img','input','keygen','link','meta','param','source','track','wbr');
        $tags = $dom->getElementsByTagName('*');
    
        for ($i = $tags->length - 1; $i >= 0; $i--) {
            $tag = $tags->item($i);
    
            if (!in_array($tag->nodeName, $exceptionsTags) && !$tag->hasChildNodes() && trim($tag->nodeValue) === '') {
                $tag->parentNode->removeChild($tag);
            }
        }
    }

    public function convertImagesToPlaceholder($inputHTML){
        $oldhtml = "<div>".file_get_contents($inputHTML)."</div>";
        $this->dom->loadHTML(mb_convert_encoding($oldhtml, 'HTML-ENTITIES', 'UTF-8'));
    
        $this->traverseDom($this->dom, $this->dom, $this->isImgBefore, $this->imgNodes, $this->firstImg);
    
        $this->removingEmptyTags($this->dom);    
        return html_entity_decode($this->dom->saveHTML());
    }
}