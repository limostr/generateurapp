<?php

$_APP_CONF=array(
    "APPNAME"=>"gestcomp"
);
$_Config=array(
    "modules"=>array(
        "referentiel"=>array(
            "name"=>"referentiel"
            ,"Controller"=>array(
                "referentiel"=>array(
                    "name"=>"referentiel",
                    "actions"=>array(
                        "gestionreferentiel"=>array(
                            "Type"=>"simple"//"AJAX"
                            ,'Role'=>"gestionmenu"
                            ,"model"=>false
                            ,"view"=>array("layout"=>"layout")
                        ),
                        "gestionobjectif"=>array(
                            "Type"=>"simple"//"AJAX"
                            ,'Role'=>"gestionmenu"
                            ,"model"=>false
                            ,"view"=>array("layout"=>"layout")
                        ),
                        "gestioncompetence"=>array(
                            "Type"=>"simple"//"AJAX"
                            ,'Role'=>"gestionmenu"
                            ,"model"=>false
                            ,"view"=>array("layout"=>"layout")
                        ),
                    ),
                )
                ,"projet"=>array(
                    "name"=>"projet",
                    "actions"=>array(
                        "edit"=>array(
                            "Type"=>"simple"//"AJAX"
                            ,'Role'=>"edit"
                            ,"view"=>array("view"=>true,"layout"=>"layout")
                            ,"activity"=>"edit"
                            ,"form"=>"formprojet"
                            ,"model"=>array(
                                "table"=>"projet"
                            )
                        ),
                        "delete"=>array(
                            "Type"=>"AJAX"//"AJAX"
                            ,'Role'=>"delete"
                            ,"view"=>array("view"=>false,"layout"=>false)
                            ,"activity"=>"delete"
                            ,"form"=>false
                            ,"model"=>array(
                                "table"=>"projet"
                            )
                        ),
                        "save"=>array(
                            "Type"=>"AJAX"//"AJAX"
                            ,'Role'=>"save"
                            ,"view"=>array("view"=>false,"layout"=>false)
                            ,"activity"=>"save"
                            ,"form"=>false
                            ,"model"=>array(
                                "table"=>"projet"
                            )
                        ),
                    ),
                )

            ),
        )
    ),
    "Menue"=>array(
                 "Referentiel"=>array(
                    "titre"=>"MENU_REFERENTIEL",
                    "url"=>array(
                        "Module"=>"referentiel"
                        ,"Controller"=>"gestionreferentiel"
                        ,"Action"=>"gestionreferentiel"
                        ,"Roles"=>array(
                            "Admin"=>array(//actions
                                "ADD",
                                "DEL",
                                "MODIF",
                                "LISTER",
                                "CONSULT",
                            )
                        )
                    ),
                    "activity"=>array( //interface View
                        "type"=>"complex", //complex : view double (sasie + liste)
                        "Mode"=>"AJAX",
                        "interface"=>array(
                               "edit"=>array(
                                   "url"=>array(
                                       "Module"=>"referentiel"
                                       ,"Controller"=>"gestionreferentiel"
                                       ,"Action"=>"gestionreferentiel"
                                       ,"Type"=>array("ADD","MODIF")
                                       ,"Roles"=>array(
                                               "Admin"=>array(//actions
                                                   "ADD",
                                                   "DEL",
                                                   "MODIF",
                                                   "LISTER",
                                                   "CONSULT",
                                               )
                                           )
                                       ),
                               ),
                               "liste"=>array(
                                   "titre"=>array("LANG"=>"TITRE_GEST_REF","DEFAULT"=>"Gestion de réferentiel"),
                                   "url"=>array(
                                       "Module"=>"referentiel"
                                       ,"Controller"=>"gestionreferentiel"
                                       ,"Action"=>"gestionreferentiel"
                                       ,"Type"=>array("LISTER", "CONSULT","GEST")
                                       ,"Roles"=>array(
                                               "Admin"=>array(//droits
                                                   "ADD",
                                                   "DEL",
                                                   "MODIF",
                                                   "LISTER",
                                                   "CONSULT",
                                                   "GEST",
                                               )
                                           )
                                       ),
                               )

                        )
                    ),
                )
    )
);