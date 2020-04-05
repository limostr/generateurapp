<?php
namespace configgen;
define("__My_PATH__", dirname(__FILE__) );
ABSTRACT class TemplateMap{
    PUBLIC STATIC $map = array(
        "global"=>array(
            "routes"=> __My_PATH__. "/../template/routes.glob.temp",
            "route"=> __My_PATH__. "/../template/routes.temp",
        ),
        "Lang"=>array(
            "LangArray"=> __My_PATH__. "/../template/lang/lang.global.temp",
            "Lang"=> __My_PATH__. "/../template/lang/lang.temp",
        ),
        "Controller"=>array(
            "Controller"=> __My_PATH__. "/../template/controller/controller.temp"
            ,"delete"=> __My_PATH__."/../template/controller/delete_action.temp"
            ,"edit"=> __My_PATH__."/../template/controller/edit_action.temp"
            ,"consulter"=> __My_PATH__."/../template/controller/consulter_action.temp"
            ,"gestion"=> __My_PATH__."/../template/controller/gestion_action.temp"
            ,"lister"=> __My_PATH__."/../template/controller/lister_action.temp"
            ,"save"=> __My_PATH__."/../template/controller/save_action.temp"

            ,'editIds'=> __My_PATH__."/../template/controller/elements/ids_edit.temp"
            ,"cndeditIds"=> __My_PATH__."/../template/controller/elements/ids_condition_edit.temp"
            ,'editwhere'=> __My_PATH__."/../template/controller/elements/ids_edit_where.temp"
            ,'editUpdateLink'=> __My_PATH__."/../template/controller/elements/ids_edit_link_update.temp"

            ,'saveAttrib'=> __My_PATH__."/../template/controller/elements/rec_save.temp"
            ,'savewhere'=> __My_PATH__."/../template/controller/elements/rec_save_where.temp"

            ,'colsListe'=> __My_PATH__."/../template/controller/elements/cols_lister.temp"
            ,"consultdata"=>__My_PATH__."/../template/controller/elements/consult_attrib.temp"

        ),
        "views"=>array(
            'edit'=>__My_PATH__."/../template/view/view.edit.temp",
            'gest'=>__My_PATH__."/../template/view/view.gest.temp",
            'lister'=>__My_PATH__."/../template/view/view.list.temp",
            'consulter'=>__My_PATH__."/../template/view/consulter.temp",

            'scriptlist'=>__My_PATH__."/../template/view/view.jsaction.temp",

            'LinkedIds'=>__My_PATH__."/../template/controller/elements/Cols_ids_linked.temp",
            'LinkedListe'=>__My_PATH__."/../template/controller/elements/liste_likedIds.temp",


            /***/

            'btn_delete'=>__My_PATH__."/../template/view/elements/actionbuton/btn_delete.temp",
            'btn_edit'=>__My_PATH__."/../template/view/elements/actionbuton/btn_update.temp",
            'btn_consult'=>__My_PATH__."/../template/view/elements/actionbuton/btn_consulter.temp",
/**/

            'menugesti'=>__My_PATH__."/../template/view/view.menugest.temp",

        ),
        "Form"=>array(
            "SelectFunction"=> __My_PATH__. "/../template/form/selectfunction.temp"
            ,"formClass"=> __My_PATH__. "/../template/form/formclass.temp"
            ,"Elts"=> __My_PATH__. "/../template/form/eltsgen.temp"
            ,"radio"=> __My_PATH__. "/../template/form/radio.temp"
            ,"checkbox"=> __My_PATH__. "/../template/form/checkbox.temp"
            ,"date"=> __My_PATH__. "/../template/form/date.temp"
            ,"datetime"=> __My_PATH__. "/../template/form/datetime.temp"
            ,"textarea"=> __My_PATH__. "/../template/form/textarea.temp"
            ,"text"=> __My_PATH__. "/../template/form/text.temp"
            ,"formClass"=>__My_PATH__. "/../template/form/formClass.temp"
            ,"select"=>__My_PATH__. "/../template/form/select.temp"

        )

        );

}
