<?


class PageControl  {
	public static $defaultPageControl;

	public $current_page=1;
	public $recordcount=0;
	public $pagesize=10;
	public $pagecount=0;
	public $dampping=2;
	public $sort='';
	public $onclick='';
	public $targetDiv='';

	public $preText='';
	public $postText='';
	
	public $offsetStart=0;
	public $offsetSize=0;
	
	public $url="";

	public function PageControl($pagesize = 10,$targetDiv='',$mpurl=NULL){

		$this->current_page = Req(page);
		$this->sort = Req(sort);
		$this->targetDiv = Req(target);
		
		if($targetDiv!=""){ 
			$this->targetDiv = $targetDiv."List";
		}
		
		$this->pagesize = $pagesize;

		if($pagesize==1000){
			$this->current_page = 1;
		}

		if(!is_numeric($this->current_page)||$this->current_page==0)
			$this->current_page = 1;

		if($mpurl==NULL){
			$mpurl = $_SERVER['PHP_SELF'];
			
			if(isset($_SERVER['QUERY_STRING']))
			{
				$mpurl .= '?' . preg_replace('/&page=[0-9]*/','',$_SERVER['QUERY_STRING']) . '&';
			}
		}else{
			$mpurl = preg_replace('/&page=[0-9]*/','', $mpurl) . '&';
		}
		
		$mpurl = str_replace("&bypass=1","",$mpurl);
		$mpurl = preg_replace('/&ms=[0-9]*/','',$mpurl);
		
		$mpurl = str_replace("&rfpage=1","",$mpurl);
		
		$this->url = $mpurl;


	}
	public function SetPreText($text){
		$this->preText = $text;

	}
	public static function BuidBlank(){
		$obj = new PageControl(100);
		$obj->current_page=1;
		return $obj;
	}

	public function GetStartRecord(){
		return ($this->current_page-1)*$this->pagesize+$this->offsetStart;
	}
	public function GetPageSize(){
		return $this->pagesize+$this->offsetSize;
	}

	public function GenSortLink($sort){
		if(strpos($this->url,"sort={$sort}")>0 || $sort==$this->sort){
			$url= preg_replace('/&sort=[a-z_0-9]*/','',$this->url);
			$url.="&sort=-$sort";
		}else{
			$url= preg_replace('/&sort=[a-z_0-9-]*/','',$this->url);
			$url.="&sort=$sort";
		}
		//echo 	$this->url;
		return str_replace('&&','&',$url);
	}
	public function IsSort($sort){
		if($sort==$this->sort) return 1;
		//echo "sort[0] {$sort[0]}";
		if($this->sort[0]=="-" && substr($this->sort,1)==$sort)return -1;
		return 0;
	}

	public function BuildHTML(){

		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = "";

		$startBtn = $this->current_page-$this->dampping;
		$stopBtn = $this->current_page+$this->dampping;
		if($startBtn<1){
			$startBtn = max(1,$startBtn-$this->dampping);
			$stopBtn = min($maxpage,$startBtn+($this->dampping*2+1));
		}
		if($stopBtn>$maxpage){
			$stopBtn = min($maxpage,$stopBtn+$this->dampping);
			$startBtn = max(1,$stopBtn-($this->dampping*2+1));
		}
		$defonclick="";
		if($this->targetDiv!=''){
			$defonclick = "onclick=\"$('#{$this->targetDiv}').load('[URL]');return false;\"";
		}
		//$html .= "<span>Found {$this->recordcount} records in $maxpage pages</span>";

		if($this->current_page>1){
			$url = $this->url.'page='.($this->current_page - 1);
			$onclick = str_replace('[URL]',$url,$defonclick);
			if($onclick!=''){
				$html .= '<a href="#" class="next"  '.$onclick.' title="'.__("Go to previous page").'">&lt;</a>';
			}else{
				$html .= '<a href="'.$url.'" class="next"  '.$onclick.' title="'.__("Go to previous page").'">&lt;</a>';
			}
		}

		if($startBtn>1){
			$url = $this->url.'page=1';
			$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" '.$onclick.' title="'.__("Go to first page").'">1</a>';
		}
		if($startBtn>2){
			$html .= '<span class="dotdotdot">...</span>';
		}



		for($i=$startBtn;$i<=$stopBtn;$i++){
			if($i==$this->current_page){
				$html .= '<a class="current" title="Current page">'.$i.'</a>';
			}else{
				$url = $this->url.'page='.$i;
				$onclick = str_replace('[URL]',$url,$defonclick);
				if($onclick!=''){
					$html .= '<a href="#" '.$onclick.' title="'.__("Go to page").' '.$i.'">'.$i.'</a>';
				}else{
					$html .= '<a href="'.$this->url.'page='.$i.'" '.$onclick.' title="'.__("Go to page").' '.$i.'">'.$i.'</a>';
				}
			}
		}
		if($stopBtn<$maxpage-1){
			$html .= '<span class="dotdotdot">...</span>';
		}
		if($stopBtn<$maxpage){
			$url = $this->url.'page='.$maxpage;
			$onclick = str_replace('[URL]',$url,$defonclick);
			if($onclick!=''){
				$html .= '<a href="#" '.$onclick.' title="'.__("Go to last page").'">'.$maxpage.'</a>';
			}else{
				$html .= '<a href="'.$url.'" '.$onclick.' title="'.__("Go to last page").'">'.$maxpage.'</a>';
			}
		}

		if($this->current_page<$maxpage){
			$url = $this->url.'page='.($this->current_page + 1);
			$onclick = str_replace('[URL]',$url,$defonclick);
			if($onclick!=''){
				$html .= '<a href="#" class="next"  '.$onclick.' title="'.__("Go to next page").'">&gt;</a>';
			}else{
				$html .= '<a href="'.$url.'" class="next"  '.$onclick.' title="'.__("Go to next page").'">&gt;</a>';
			}
		}


		return $html;

	}
	public function BuildHTMLAjax($currentpage=0){
		if($currentpage>0){
			$this->current_page = $currentpage;
		}
	
		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = "";
		
		$startBtn = $this->current_page-$this->dampping;
		$stopBtn = $this->current_page+$this->dampping;
		if($startBtn<1){
			$startBtn = max(1,$startBtn-$this->dampping);
			$stopBtn = min($maxpage,$startBtn+($this->dampping*2+1));
		}
		if($stopBtn>$maxpage){
			$stopBtn = min($maxpage,$stopBtn+$this->dampping);
			$startBtn = max(1,$stopBtn-($this->dampping*2+1));
		}
		/*$defonclick="";
		if($this->targetDiv!=''){
			$defonclick = "onclick=\"$('#{$this->targetDiv}').load('[URL]');return false;\"";
		}*/
		
		//$html .= "<span>Found {$this->recordcount} records in $maxpage pages</span>";
	

		$html .= '<a href="#page_'.$this->targetDiv.'_'.($this->current_page-1).'" onclick="PageCtrlChange_'.$this->targetDiv.'(currentpage_'.$this->targetDiv.'-1);return false;" class="next" title="'.__("Go to previous page").'">&lt;</a>';
		
		if($startBtn>1){
			$url = $this->url.'page=1';
			/*$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" '.$onclick.' title="Go to first page">1</a>';*/
			$html .= '<a href="#page_'.$this->targetDiv.'_1" class="'.($i==$this->current_page?'current ':'').'page1" onclick="PageCtrlChange_'.$this->targetDiv.'(1);return false;" title="'.__("Go to first page").'">1</a>';
		}
		if($startBtn>2){
			$html .= '<span class="dotdotdot">...</span>';
		}
	
	
	
		for($i=$startBtn;$i<=$stopBtn;$i++){
			$html .= '<a href="#page_'.$this->targetDiv.'_'.$i.'" class="'.($i==$this->current_page?'current ':'').'page'.$i.'" onclick="PageCtrlChange_'.$this->targetDiv.'('.$i.');" title="'.__("Go to page").' '.$i.'">'.$i.'</a>';
		}
		if($stopBtn<$maxpage-1){
			$html .= '<span class="dotdotdot">...</span>';
		}
		if($stopBtn<$maxpage){
			$url = $this->url.'page='.$maxpage;
			$onclick = str_replace('[URL]',$url,$defonclick);
			if($onclick!=''){
				$html .= '<a href="#page_'.$this->targetDiv.'_'.$maxpage.'" '.$onclick.' title="'.__("Go to last page").'">'.$maxpage.'</a>';
			}else{
				$html .= '<a href="#page_'.$this->targetDiv.'_'.$maxpage.'" class="'.($maxpage==$this->current_page?'current ':'').'page'.$maxpage.'" onclick="PageCtrlChange_'.$this->targetDiv.'('.$maxpage.');return false;" title="'.__("Go to page").' '.$maxpage.'">'.$maxpage.'</a>';
			}
		}
	

		$html .= '<a href="#page_'.$this->targetDiv.'_'.($this->current_page+1).'" onclick="PageCtrlChange_'.$this->targetDiv.'(currentpage_'.$this->targetDiv.'+1);return false;" class="next"  '.$onclick.' title="'.__("Go to next page").'">&gt;</a>';		
	
	
		return $html;
	
	}
	

	/*public function BuildAjax(){

		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = "";


		$startBtn = $this->current_page-$this->dampping;
		$stopBtn = $this->current_page+$this->dampping;
		if($startBtn<1){
			$startBtn = max(1,$startBtn-$this->dampping);
			$stopBtn = min($maxpage,$startBtn+($this->dampping*2+1));
		}
		if($stopBtn>$maxpage){
			$stopBtn = min($maxpage,$stopBtn+$this->dampping);
			$startBtn = max(1,$stopBtn-($this->dampping*2+1));
		}
		$defonclick="";
		if($this->targetDiv!=''){
			$defonclick = "onclick=\"showHTML('{$this->targetDiv}','[URL]');return false;\"";
		}
		//$html .= "<span>Found {$this->recordcount} records in $maxpage pages</span>";

		if($this->current_page>1){
			$url = $this->url.'page='.($this->current_page - 1);
			$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" class="next"  '.$onclick.'>&lt;</a>';
		}

		if($startBtn>1){
			$url = $this->url.'page=1';
			$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" '.$onclick.'>1</a>';
		}
		if($startBtn>2){
			$html .= '<span>...</span>';
		}



		for($i=$startBtn;$i<=$stopBtn;$i++){
			if($i==$this->current_page){
				$html .= '<a class="current">'.$i.'</a>';
			}else{
				$url = $this->url.'page='.$i;
				$onclick = str_replace('[URL]',$url,$defonclick);
				$html .= '<a href="'.$this->url.'page='.$i.'" '.$onclick.'>'.$i.'</a>';
			}
		}
		if($stopBtn<$maxpage-1){
			$html .= '<span>...</span>';
		}
		if($stopBtn<$maxpage){
			$url = $this->url.'page='.$maxpage;
			$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" '.$onclick.'>'.$maxpage.'</a>';
		}

		if($this->current_page<$maxpage){
			$url = $this->url.'page='.($this->current_page + 1);
			$onclick = str_replace('[URL]',$url,$defonclick);
			$html .= '<a href="'.$url.'" class="next"  '.$onclick.'>&gt;</a>';
		}


		return $html;

	}	*/
	public function BuildFullHTML(){
		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = '<div class="pages-nav" id="pages-nav-'.$this->targetDiv.'">'.
"<span class=\"summary\">{$this->preText}".sprintf(__("Found %s records in %s pages"),"<strong><span id=\"recordcount\">{$this->recordcount}</span></strong>","<strong>$maxpage</strong>")." {$this->postText}</span>".''.$this->BuildHTML().'</div>';
		return $html;
	}
	public function BuildFullHTMLAjax($targetdiv=''){
		$this->targetDiv = $targetdiv;
		if($this->targetDiv!=''){
			$remove_selector = '$("tr.record-list,tr.sub-record-list",$("#'.$this->targetDiv.'"))';	
		}else{
			$remove_selector = '$("tr.record-list,tr.sub-record-list")';
		}
		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = '
			<script>
			if(typeof(PageCtrlChange_'.$this->targetDiv.') == "undefined"){
			  var currentpage_'.$this->targetDiv.' = '.$this->current_page.';
			  function PageCtrlChange_'.$this->targetDiv.'(page){
				  $display_elm = $("#fhq-main-display").children("div.div-main-auto");
				  if($display_elm.length>0){
					  $display_elm.height($display_elm.height());
				  }
				  disable_LoggerNofity = true;
				  if(page<1 || page>'.$maxpage.') return;
				  currentpage_'.$this->targetDiv.' = page;
				  if(!$("#pages-nav-'.$this->targetDiv.' span.pagination a.page"+page).hasClass("current")){
					  '.$remove_selector.'.remove();
					  ReloadRepeatRecord("'.$this->url.'rfpage=1&target='.$this->targetDiv.'&page="+page,false,function(data){
						  disable_LoggerNofity = false;
						  $("#pages-nav-'.$this->targetDiv.' span.pagination").html(data.option.pagectrl);
					  });
				  }
			  }
			}
			$(document).ready(function(){
				if(typeof(currentpage_'.$this->targetDiv.')=="undefined" || currentpage_'.$this->targetDiv.'==0){
					currentpage_'.$this->targetDiv.' = '.$this->current_page.';
				}
			});

		  if(typeof(PageCtrlRefill_'.$this->targetDiv.') == "undefined"){
          	var currentpage_'.$this->targetDiv.' = '.$this->current_page.';
          	function PageCtrlRefill_'.$this->targetDiv.'(refill){
          		disable_LoggerNofity = true;
          		page = currentpage_'.$this->targetDiv.';
          		ReloadRepeatRecord("'.$this->url.'rfpage=1&target='.$this->targetDiv.'&page="+page+"&refill="+refill,true,function(data){
					disable_LoggerNofity = false;
				});
          		
          	}
          }
								
          </script>
		          
		          <div class="pages-nav" id="pages-nav-'.$this->targetDiv.'">'.
	"<span class=\"summary\">{$this->preText}".sprintf(__("Found %s records in %s pages"),"<strong><span id=\"recordcount\">{$this->recordcount}</span></strong>","<strong>$maxpage</strong>")." {$this->postText}</span><span class='pagination'>".''.$this->BuildHTMLAjax().'</span></div>';
		return $html;
	}
	
	
	
	/*public function BuildSmallHTML(){
		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = '<div class="pages-nav"
style="PADDING-RIGHT: 0px! important; PADDING-LEFT: 0px! important; PADDING-BOTTOM: 2px! important; MARGIN: 2px 2px 0px 0px; PADDING-TOP: 0px! important">'.
"<span>{$this->preText}Found {$this->recordcount}{$this->postText}</span>".''.$this->BuildHTML().'</div>';
		return $html;
	}*/
	/*public function BuildFullAjax(){
		$maxpage = ceil($this->recordcount/$this->pagesize);
		if($maxpage<=1)return "";
		$html = '<div class="pages-nav"
style="PADDING-RIGHT: 0px! important; PADDING-LEFT: 0px! important; PADDING-BOTTOM: 2px! important; MARGIN: 2px 2px 0px 0px; PADDING-TOP: 0px! important">'.
"<span>{$this->preText}Found {$this->recordcount} records in $maxpage pages{$this->postText}</span>".''.$this->BuildAjax().'</div>';
		return $html;
	}	*/
	
	
}



PageControl::$defaultPageControl = new PageControl();
function PageCtrl()
{
	return PageControl::$defaultPageControl;
}


