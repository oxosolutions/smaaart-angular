<?php



$settings = [
            
       'chartType' 				=> 	'LineChart',

       'title'     				=> 	['label'=>'Title','type'=>'text','options'=>[],'isArray'=>'false'],

       'is3D'      				=> 	['label'=>'3D Chart','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       'pieHole'   				=> 	['label'=>'Pie Hole','type'=>'text','options'=>[],'isArray'=>'false'],

       'width'     				=> 	['label'=>'Width','type'=>'text','options'=>[],'isArray'=>'false'],

       'height'    				=> 	['label'=>'Height','type'=>'text','options'=>[],'isArray'=>'false'],

       'colors'    				=> 	['label'=>'Colors','type'=>'text','options'=>[],'isArray'=>'false'],

       'pieStartAngle'			=> 	['label'=>'Pie Start Angle','type'=>'text','options'=>[],'isArray'=>'false'],

       'reverseCategories'		=> 	['label'=>'Reserve Categories','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       'pieSliceBorderColor'	=>	['label'=>'Pie Slce Border Color','type'=>'text','options'=>[],'isArray'=>'false'],

       'pieStartAngle'			=>	['label'=>'Pie Start Angle','type'=>'text','options'=>[],'isArray'=>'false'],

       'animation'				=>	[
       									'statup' 	=>	['label'=>'Statup','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       									'duration'	=>	['label'=>'Duration','type'=>'text','options'=>[],'isArray'=>'false'],

       									'easing'	=>	['label'=>'Easing','type'=>'select',
       																		'options'=>[
       																					'inAndOut'=>'inAndOut','in'=>'In','out'=>'Out'
       																				   ],
       																		'isArray'=>'false'],

       									'isArray'	=>	'true'
       								],

       	'legend'				=>	['label'=>'Legend','type'=>'select',
       																'options'	=>	
       																		['top'=>'Top','bottom'=>'Bottom','left'=>'Left','right'=>'Right'],
       																'isArray'=>'false'],

       	'curveType'				=>	['label'=>'Curve Type','type'=>'select','options'=>['none'=>'None','function'=>'Smooth'],'isArray'=>'false'],

       	'pointSize'				=>	['label'=>'Point Size','type'=>'text','options'=>[],'isArray'=>'false'],

       	'chartArea'				=>	[
       									'left'		=>	['label'=>'Left','type'=>'text','options'=>[],'isArray'=>'false'],
       									'top'		=>	['label'=>'Top','type'=>'text','options'=>[],'isArray'=>'false'],
       									'bottom'	=>	['label'=>'Bottom','type'=>'text','options'=>[],'isArray'=>'false'],
       									'height'	=>	['label'=>'Height','type'=>'text','options'=>[],'isArray'=>'false'],
       									'width'		=>	['label'=>'Width','type'=>'text','options'=>[],'isArray'=>'false'],
       									'isArray'   =>  'true'
       								],

       	'bar'					=>	[	
       									'groupWidth'	=>	['label'=>'Group Width','type'=>'text','options'=>[],'isArray'=>'false'],
       									'isArray'	=>	'true'
       								],
       	'tooltip'				=>	[
       									'isHtml'		=>	['label'=>'Is HTML','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       									'showColorCode'	=>	['label'=>'Show Color Code','type'=>'select',
       																					'options'=>['true'=>'True','false'=>'False'],
       																					'isArray'=>'false'],
       									'isArray'	=>	'true'
       								],
       	'backgroundColor'		=>	['label'=>'Background Color','type'=>'text','options'=>[],'isArray'=>'false'],

       	'isStacked'				=>	['label'=>'Is Stacked','type'=>'select',
       															'options'=>['true'=>'True','percent'=>'Percent','relative'=>'Relative','absolute'=>'Absolute'],
       															'isArray'=>'false'
       															],
       	'lineWidth'				=>	['label'=>'Line Width','type'=>'text','options'=>[],'isArray'=>'false'],

       	'hAxis'					=>	[
       									'textPosition'	=>	['label'=>'Text Position','type'=>'select',
       																						'options'=>['horizontal'=>'Horizontal','vertical'=>'Vertical'],
       																						'isArray'=>'false'],
       									'gridlines'		=>	[
       															'color'	=>	['label'=>'Grid Line Color','type'=>'text','options'=>[],'isArray'=>'false'],
       															'isArray' => 'true'
       														],
       									'isArray'	=>	'true'
       								],
       	'enableInteractivity'	=>	['label'=>'Enable Interactivity','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       	'fontSize'				=>	['label'=>'Font Size','type'=>'text','options'=>[],'isArray'=>'false'],

       	'fontName'				=>	['label'=>'Font Name','type'=>'text','options'=>[],'isArray'=>'false'],

       	'forceIFrame'			=>	['label'=>'Force iFrame','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       	'areaOpacity'			=>	['label'=>'Area Opacity','type'=>'text','options'=>[],'isArray'=>'false'],

       	'bubble'				=>	[	
       									'opacity'	=>	['label'=>'Bubble Opacity','type'=>'text','options'=>[],'isArray'=>'false'],
       									'stroke'	=>	['label'=>'Bubble Stroke color','type'=>'text','options'=>[],'isArray'=>'false'],
       									'isArray'	=>	'true'
       								],
       	'sizeAxis'				=>	[	
       									'maxSize'	=>	['label'=>'Size Axis Max Size','type'=>'text','options'=>[],'isArray'=>'false'],
       									'isArray'	=>	'true'
       								],

       	'keepAspectRatio'		=>	['label'=>'keep Aspect Ratio','type'=>'select','options'=>['true'=>'True','false'=>'False'],'isArray'=>'false'],

       	'colorAxis'				=>	['label'=>'Color Axis','type'=>'text','options'=>[],'isArray'=>'false']

    ];