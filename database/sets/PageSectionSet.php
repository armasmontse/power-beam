<?php
use App\Console\Cltvo\SetSite\CltvoSet;
use Illuminate\Console\Command;

use App\Models\Pages\Sections\Section;
use App\Models\Pages\Sections\Type;

class PageSectionSet extends CltvoSet
{
    /**
     * Etiqueta a desplegarse par ainformar final
     */
    protected $label =  "Secciones de páginas";

	/**
     * etiqueta del display del modelo
     * @var string
     */
    protected $model_label =  "index";



    /**
     * nombre de la clase a ser sembrada
     */
    protected function CltvoGetModelClass(){
        return Section::class;
    }

    /**
     * valores a ser introducidos en la base
     */

	protected function CltvoGetItems(){
        $types = Type::get();

        $fija = $types->where("protected",false)
            ->where("unlimited",false)
            ->where("sortable",false)
            ->first();
        $ilimitada = $types->where('protected', false)
            ->where('unlimited', true)
            ->where('sortable', true)
            ->first();

		$limitada = $types->where('protected', false)
			->where('unlimited', false)
			->where('sortable', true)
			->first();

		$especial = $types->where('protected', true)
			->where('unlimited', false)
			->where('sortable', false)
			->first();

        return [
			// [
			// 	'index'             => 'contact-form',
			// 	'template_path'     => 'contact_form',
			// 	'components_max'    => null,
			// 	'type_id'           => $especial->id,
			// 	'editable_contents' => [
			// 		'gallery_img'   => false,
			// 		'thumbnail_img' => false,
			//
			// 		'title'         => false,
			// 		'subtitle'      => false,
			// 		'excerpt'       => false,
			// 		'content'       => false,
			// 		'iframe'        => false,
			// 		'link'          => false
			// 	],
			// 	'description'       => 'Formulario de contacto',
			// ],
		// main
            [
                'index'             => 'home-splash',
                'template_path'     => 'home.splash',
                'components_max'    =>  1,
                'type_id'           => $fija->id,
                'editable_contents' => [
					'gallery_img'   => false,
			        'thumbnail_img' => true,

			        'title'         => true,
			        'subtitle'      => false,
			        'excerpt'       => false,
			        'content'       => false,
			        'iframe'        => false,
			        'link'          => true
                ],
                'description'       => '<b>Splash</b>: splash pages are used to generate promotion  or are used to give the user information. <br><br>
                                        <b>Assign a name</b> to the section to identify it <br>
                                        <b>Image</b>: it will be displayed at the back of the page. <br>
                                        <b>Title</b>: it will be set at the center of the splash just above the link button. <br>
                                        <b>Link</b>: text shown in the button. <br>
                                        <b>Link Url</b>: address where you will be redirected when the button is clicked. <br>
                                        You can decide if the link is opened in the <b>same</b> window or a <b>new</b> one in the same browser. <br>'
            ],
			// [
			// 	'index'             => 'home-offers-title',
			// 	'template_path'     => 'home.offers-title',
			// 	'components_max'    => 1,
			// 	'type_id'           => $fija->id,
			// 	'editable_contents' => [
			// 		'gallery_img'   => false,
			// 		'thumbnail_img' => false,
			//
			// 		'title'         => true,
			// 		'subtitle'      => true,
			// 		'excerpt'       => false,
			// 		'content'       => false,
			// 		'iframe'        => false,
			// 		'link'          => false
			// 	],
			// 	'description'       => 'pending' // debe ser un tml que se va a mostrar a los usuarios como intrucciones
			// ],
			[
				'index'             => 'home-offers',
				'template_path'     => 'home.offers',
				'components_max'    => null,
				'type_id'           => $ilimitada->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => false,

					'title'         => true,
					'subtitle'      => false,
					'excerpt'       => false,
					'content'       => false,
					'iframe'        => false,
					'link'          => false
				],
				'description'       => '<b>Offers</b>: in this section you can show information such as qualities or features from your straff. <br><br>
                                <b>Assign a name</b> to the section to identify each offer<br>
                                <b>Title</b>: text shown. <br>
                                <b>Save</b>: save changes for the title text. <br>
                                <b>Add</b>: add a new offer in the current order. <br>
                                <b>Delete Icon</b>: delete the current offer. <br>
                                <b>Arrows</b> change the offer s order. Remember to save it with the <b>save</b> button at the <b>bottom</b>. <br>'
			],
			[
				'index'             => 'home-banner',
				'template_path'     => 'home.banner',
				'components_max'    => 1,
				'type_id'           => $fija->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => false,

					'title'         => false,
					'subtitle'      => false,
					'excerpt'       => true,
					'content'       => false,
					'iframe'        => false,
					'link'          => true
				],
				'description'       => '<b>Banner</b>: this section is used to bring up attention from customers, is often used to refer to a form of advertising. <br><br>
                                <b>Assign a name</b> to the section to identify it <br>
                                <b>Excerpt</b>: text displayed in the whole banner. <br>
                                <b>Link</b>: this text will not be shown, but you can fill it . <br>
                                <b>Link Url</b>: address where you will be redirected when the banner is clicked. <br>
                                You can decide if the link is opened in the <b>same</b> window or a <b>new</b> one in the same browser. <br>'
			],

      [
				'index'             => 'home-icons',
				'template_path'     => 'home.icons',
				'components_max'    => null,
				'type_id'           => $ilimitada->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => true,

					'title'         => true,
					'subtitle'      => false,
					'excerpt'       => false,
					'content'       => false,
					'iframe'        => false,
					'link'          => false
				],
				'description'       => '<b>Icons</b>: in here you can take advantage of the slides by showing a series of steps to complete certain action related to the site, such as downloading an app. <br><br>
                                <b>Assign a name</b> to each icon to identify it <br>
                                <b>Image</b>: it wil be displayed and distributed depending on the number of icons. <br>
                                <b>Title</b>: name for each icon. <br>
                                <b>Save</b>: save changes for each icon. <br>
                                <b>Add</b>: add a new icon in the current order. <br>
                                <b>Delete Icon</b>: delete the current icon. <br>
                                <b>Arrows</b> change the icon s order. Remember to save it with the <b>save</b> button at the <b>bottom</b>. <br>'
			],

			[
				'index'             => 'home-break',
				'template_path'     => 'home.break',
				'components_max'    => 1,
				'type_id'           => $fija->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => true,

					'title'         => false,
					'subtitle'      => false,
					'excerpt'       => false,
					'content'       => false,
					'iframe'        => false,
					'link'          => true
				],
				'description'       => '<b>Break</b>: this section is used as a visual rest but it can also be taken as a go-to action. <br><br>
                                <b>Assign a name</b> to the section to identify it <br>
                                <b>Image</b>: it will fill the whole section. <br>
                                <b>Link</b>: text shown in the button. <br>
                                <b>Link Url</b>: address where you will be redirected when the section is clicked. <br>
                                You can decide if the link is opened in the <b>same</b> window or a <b>new</b> one in the same browser. <br>'
			],
			[
				'index'             => 'home-slider',
				'template_path'     => 'home.slider',
				'components_max'    => null,
				'type_id'           => $ilimitada->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => false,

					'title'         => true,
					'subtitle'      => true,
					'excerpt'       => false,
					'content'       => true,
					'iframe'        => false,
					'link'          => false
				],
				'description'       => '<b>Slider</b>: in here you can add a series of links or as a storage of good impresions. <br><br>
                                <b>Assign a name</b> to identify each slide element <br>
                                <b>Title</b>: it will be set at the center of the slide. <br>
                                <b>Subtitle</b>: displayed under the title. <br>
                                <b>Content</b>: text shown at the top of the slide. <br>
                                <b>Add</b>: add a new slide in the current order. <br>
                                <b>Delete Icon</b>: delete the current slide. <br>
                                <b>Save</b>: save changes for each slide. <br>'
			],
			[
				'index'             => 'home-contact',
				'template_path'     => 'home.contact',
				'components_max'    => null,
				'type_id'           => $ilimitada->id,
				'editable_contents' => [
					'gallery_img'   => false,
					'thumbnail_img' => false,

					'title'         => true,
					'subtitle'      => false,
					'excerpt'       => false,
					'content'       => true,
					'iframe'        => false,
					'link'          => false
				],
				'description'       => '<b>Contact</b>: This will help user s to contact you. <br><br>
                                <b>Assign a name</b> to identify each contact.  <br>
                                <b>Title</b>: describe the contact you are adding. <br>
                                <b>Content</b>: write as much information as you believe necessary. <br>
                                <b>Save</b>: save changes for each contact. <br>
                                <b>Add</b>: add a new contact in the current order. <br>
                                <b>Delete Icon</b>: delete the current contact. <br>
                                <b>Arrows</b> change the icon s order. Remember to save it with the <b>save</b> button at the <b>bottom</b>. <br>'
			],
            // Términos y condiciones
			[
				'index'             => 'terms-conditions',
				'template_path'     => '_content_page',
				'components_max'    =>   1,
				'type_id'           => $fija->id,
				'editable_contents' => [
					'title'			=> true,
					'content'       => true,
				],
				'description'       =>' <b>- Title:</b> Terms and conditions <br/> <b>- Content:</b> terms and conditions description'
			],
        ];
    }
	/**
	 * metodo de introduccion de valores
	 * @param array   $model_args argumentos que definiran el
	 * @param Command $comand     comando actual
	 */
	protected function CltvoSower(array $model_args, Command $comand){

		$model_class = $this->CltvoGetModelClass();

		$model = $model_class::where(['index'	=>	$model_args['index']])->get()->first();

		if(!$model){
				$model = $model_class::create($model_args);
			if ($model) {
				try {
					$componets = $model->all_components;
				} catch (Exception $e) {
					$comand->error('<error>'.$model_args[$this->model_label].':</error>'." components not successfully set.");
				}
				$comand->line(  '<info>'.$model_args[$this->model_label].':</info>'." successfully set.");
			}else{
				$comand->error('<error>'.$model_args[$this->model_label].':</error>'." not successfully set.");
			}
		}else {
			$comand->line('<comment>'.$model_args[$this->model_label].':</comment>'." previously set.");
		}
	}

}
