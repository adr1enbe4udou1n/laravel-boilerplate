export default {
    "ar": {
        "alerts": {
            "backend": {
                "users": {
                    "created": "تم إنشاء المستخدم",
                    "updated": "تم تعديل المستخدم",
                    "deleted": "تم حذف المستخدم",
                    "bulk_destroyed": "تم حذف المستخدمين المختارين",
                    "bulk_enabled": "تم تفعيل المستخدمين المختارين",
                    "bulk_disabled": "تم تعطيل المستخدمين المختارين"
                },
                "roles": {
                    "created": "تم إنشاء الدور",
                    "updated": "تم تعديل الدور",
                    "deleted": "تم حذف الدور"
                },
                "metas": {
                    "created": "تم إنشاء البيانات الوصفية",
                    "updated": "تم تعديل البيانات الوصفية",
                    "deleted": "تم حذف البيانات الوصفية",
                    "bulk_destroyed": "تم حذف البيانات الوصفية المختارة"
                },
                "form_submissions": {
                    "deleted": "تم حذف المرسَل",
                    "bulk_destroyed": "تم حذف المرسَلات المختارة"
                },
                "form_settings": {
                    "created": "تم إنشاء إعداد الإستمارة",
                    "updated": "تم تعديل إعداد الإستمارة",
                    "deleted": "تم حذف إعداد الإستمارة"
                },
                "redirections": {
                    "created": "تم إنشاء قاعدة التوجيه",
                    "updated": "تم تعديل قاعدة التوجيه",
                    "deleted": "تم حذف قاعدة التوجيه",
                    "bulk_destroyed": "تم حذف قواعد التوجيه المختارة",
                    "bulk_enabled": "تم تفعيل قواعد التوجيه المختارة",
                    "bulk_disabled": "تم تعطيل قواعد التوجيه المختارة",
                    "file_imported": "تم إستيراد الملف بنجاح"
                },
                "posts": {
                    "created": "تم إنشاء المقالة",
                    "updated": "تم تعديل المقالة",
                    "deleted": "تم حذف المقالة",
                    "bulk_destroyed": "تم حذف المقالات المختارة",
                    "bulk_published": "تم نشر المقالات المختارة",
                    "bulk_pending": "المقالات المختارة قيد المراجعة",
                    "bulk_pinned": "تم تثبيت المقالات المختارة",
                    "bulk_promoted": "تم ترقية المقالات المختارة"
                },
                "actions": {
                    "invalid": "إجراء غير صالح"
                }
            },
            "frontend": []
        },
        "auth": {
            "failed": "البيانات المدخلة لا تتطابق مع قاعدة بياناتنا.",
            "throttle": "تم تجريب عدد كبير من محاولات الدخول. يرجى المحاولة مجدداً بعد {seconds} ثانية."
        },
        "buttons": {
            "cancel": "إلغاء",
            "save": "حفظ",
            "close": "إغلاق",
            "create": "إنشاء",
            "delete": "حذف",
            "confirm": "تأكيد",
            "show": "عرض",
            "edit": "تعديل",
            "update": "تحديث",
            "view": "مشاهدة",
            "preview": "معاينة",
            "back": "تراجع",
            "send": "إرسال",
            "login-as": "تسجيل الدخول كـ {name}",
            "apply": "تطبيق",
            "users": {
                "create": "إنشاء مستخدم"
            },
            "roles": {
                "create": "إنشاء دور"
            },
            "metas": {
                "create": "إنشاء معلومة وصفية"
            },
            "form_settings": {
                "create": "إنشاء إعداد"
            },
            "redirections": {
                "create": "إنشاء قاعدة توجيه",
                "import": "إستيراد CSV"
            },
            "posts": {
                "create": "إنشاء مقالة",
                "save_and_publish": "حفظ ونشر",
                "save_as_draft": "حفظ كمسودة"
            }
        },
        "exceptions": {
            "general": "خطأ في الخادم",
            "unauthorized": "إجراء غير مسموح",
            "backend": {
                "users": {
                    "create": "خطأ في إنشاء المستخدم",
                    "update": "خطأ في تعديل المستخدم",
                    "delete": "خطأ في حذف المستخدم",
                    "first_user_cannot_be_edited": "لا يمكن تعديل معلومات المستخدم كامل الصلاحيات",
                    "first_user_cannot_be_disabled": "لا يمكن تعطيل حساب المستخدم كامل الصلاحيات",
                    "first_user_cannot_be_destroyed": "لا يمكن حذف حساب المستخدم كامل الصلاحيات",
                    "first_user_cannot_be_impersonated": "لا يمكن إنتحال شخصية المستخدم كامل الصلاحيات",
                    "cannot_set_superior_roles": "لا يمكنك الحصول على أدوار تفوق الدور الخاص بك"
                },
                "roles": {
                    "create": "خطأ في إنشاء الدور",
                    "update": "خطأ في تعديل الدور",
                    "delete": "خطأ في حذف الدور"
                },
                "metas": {
                    "create": "خطأ في إنشاء المعلومة الوصفية",
                    "update": "خطأ في تعديل المعلومة الوصفية",
                    "delete": "خطأ في حذف المعلومة الوصفية",
                    "already_exist": " يوجد معلومات وصفية لهذا الرابط منشأ مسبقاً"
                },
                "form_submissions": {
                    "create": "خطأ في إنشاء المرسَل",
                    "delete": "خطأ في حذف المرسَل"
                },
                "form_settings": {
                    "create": "خطا في إنشاء إعداد الإستمارة",
                    "update": "خطا في تعديل إعداد الإستمارة",
                    "delete": "خطا في حذف إعداد الإستمارة",
                    "already_exist": "يوجد إعداد مرتبط بهذه الإستمارة منشأ مسبقاً"
                },
                "redirections": {
                    "create": "خطأ في إنشاء قاعدة التوجيه",
                    "update": "خطأ في تعديل قاعدة التوجيه",
                    "delete": "خطأ في حذف قاعدة التوجيه",
                    "already_exist": " يوجد قاعدة توجيه لهذا المسار منشأة مسبقاً"
                },
                "posts": {
                    "create": "خطأ في إنشاء المقالة",
                    "update": "خطأ في تعديل المقالة",
                    "save": "خطأ في حفظ المقالة",
                    "delete": "خطأ في حذف المقالة"
                }
            },
            "frontend": {
                "user": {
                    "email_taken": "عنوان البريد المدخل موجود مسبقاً.",
                    "password_mismatch": "لا يوجد تطابق مع كلمة المرور القديمة.",
                    "delete_account": "خطأ في حذف الحساب.",
                    "updating_disabled": "تعديل معلومات الحساب غير مفعل."
                },
                "auth": {
                    "registration_disabled": "عملية التسجيل غير مفعلة."
                }
            }
        },
        "forms": {
            "contact": {
                "display_name": "إستمارة الإتصال"
            }
        },
        "labels": {
            "language": "اللغة",
            "actions": "الإجراءات",
            "general": "عام",
            "no_results": "لا يوجد نتائج",
            "search": "بحث",
            "validate": "تحقق",
            "choose_file": "أختر ملف",
            "no_file_chosen": "لم يتم إختيار ملف",
            "are_you_sure": "هل أنت متأكد ؟",
            "delete_image": "حذف الصورة",
            "yes": "نعم",
            "no": "لا",
            "add_new": "إضافة",
            "export": "تصدير",
            "more_info": "المزيد من المعلومات",
            "author": "الكاتب",
            "last_access_at": "أخر وصول في",
            "published_at": "تم النشر بتاريخ",
            "created_at": "تم الإنشاء بتاريخ",
            "updated_at": "تم التعديل بتاريخ",
            "deleted_at": "تم الحذف بتاريخ",
            "no_value": "لا يوجد قيمة",
            "upload_image": "رفع صورة",
            "anonymous": "مجهول",
            "all_rights_reserved": "جميع الحقوق محفوظة.",
            "with": "مع",
            "by": "بواسطة",
            "datatables": {
                "no_results": "لا يوجد نتائج",
                "no_matched_results": "لا يوجد نتائج مطابقة",
                "show_per_page": "إظهار",
                "entries_per_page": "عنصر بالصفحة",
                "search": "بحث",
                "infos": "إظهار {offset_start} حتى {offset_end} من أصل {total} عنصر"
            },
            "morphs": {
                "post": "مقالة، المعرف {id}",
                "user": "مستخدم، المعرف {id}"
            },
            "auth": {
                "disabled": "تم إلغاء تفعيل الحساب الخاص بك."
            },
            "http": {
                "403": {
                    "title": "وصول مرفوض",
                    "description": "عذراً، ليس لديك صلاحية الوصول لهذه الصفحة."
                },
                "404": {
                    "title": "الصفحة غير موجودة",
                    "description": "عذراً، إن الصفحة التي تحاول الوصول لها غير موجودة."
                },
                "500": {
                    "title": "خطأ في المخدّم",
                    "description": "عذراً، حدث خطأ غير متوقع في المخدم. سيتم معالجة المشكلة بالسرعة الممكنة."
                }
            },
            "localization": {
                "en": "إنكليزي",
                "fr": "فرنسي",
                "ar": "عربي"
            },
            "placeholders": {
                "route": "يرجى إختيار مسار داخلي صحيح",
                "tags": "إختر أو أنشئ وسماً"
            },
            "cookieconsent": {
                "message": "يستخدم موقع الويب هذا ملفات تعريف الارتباط لضمان حصولك على أفضل تجربة على موقعنا.",
                "dismiss": "تم !"
            },
            "descriptions": {
                "allowed_image_types": "أنواع الصور المسموحة: png gif jpg jpeg."
            },
            "user": {
                "dashboard": "لوحة التحكم",
                "remember": "تذكرني",
                "login": "تسجيل الدخول",
                "logout": "تسجيل الخروج",
                "password_forgot": "نسيت كلمة المرور ؟",
                "send_password_link": "إرسال رابط إعادة تعيين كلمة المرور",
                "password_reset": "إعادة تعيين كلمة المرور",
                "register": "تسجيل",
                "space": "مساحتي",
                "settings": "إعدادات",
                "account": "حسابي",
                "profile": "ملفي",
                "avatar": "الصورة الرمزية",
                "online": "أون لاين",
                "edit_profile": "تعديل ملفي",
                "change_password": "تغير كلمة مروري",
                "delete": "حذف حسابي",
                "administration": "إدارة",
                "member_since": "عضو منذ {date}",
                "profile_updated": "تم تعديل معومات الملف بنجاح.",
                "password_updated": "تم تعديل كلمة المرور بنجاح",
                "super_admin": "مدير بصلاحيات كاملة",
                "account_delete": "<p>إن القيام بهذا الإجراء سيؤدي لحذف حسابك بشكل كامل من الموقع مع جميع المعلومات ذات الصلة.<\/p>",
                "account_deleted": "تم حذف الحساب بنجاح",
                "titles": {
                    "space": "مساحتي",
                    "account": "حسابي"
                }
            },
            "alerts": {
                "login_as": "يتم تسجيل دخولك فعليًا باسم <strong>{name} <\/strong> ، ويمكنك الخروج كـ <a href=\"{route}\" data-turbolinks=\"false\">{admin} <\/a>."
            },
            "backend": {
                "dashboard": {
                    "new_posts": "مقالات جديدة",
                    "pending_posts": "مقالات معلّقة",
                    "published_posts": "مقالات منشورة",
                    "active_users": "مستخدمين فعّالين",
                    "form_submissions": "مرسَلات",
                    "last_posts": "أحدث المقالات",
                    "last_published_posts": "أحدث المنشورات",
                    "last_pending_posts": "أحدث المقالات المعلّقة",
                    "last_new_posts": "أحدث المقالات الجديدة",
                    "all_posts": "جميع المقالات"
                },
                "new_menu": {
                    "post": "مقالة جديدة",
                    "form_setting": "إعداد إستمارة جديد",
                    "user": "مستخدم جديد",
                    "role": "دور جديد",
                    "meta": "معلومة وصفية جديدة",
                    "redirection": "قاعدة توجيه جديدة"
                },
                "sidebar": {
                    "content": "إدارة المحتوى",
                    "forms": "إدارة الإستمارات",
                    "access": "إدارة الوصول",
                    "seo": "إعدادات تحسين محركات البحث"
                },
                "titles": {
                    "dashboard": "لوحة التحكم"
                },
                "users": {
                    "titles": {
                        "main": "إدارة المستخدمين",
                        "index": "عرض المستخدمين",
                        "create": "إنشاء مستخدم",
                        "edit": "تعديل مستخدم"
                    },
                    "actions": {
                        "destroy": "حذف المستخدمين المختارين",
                        "enable": "تفعيل المستخدمين المختارين",
                        "disable": "إلغاء تفعيل المستخدمين المختارين"
                    }
                },
                "roles": {
                    "titles": {
                        "main": "إدارة الأدوار",
                        "index": "عرض الأدوار",
                        "create": "إنشاء دور",
                        "edit": "تعديل دور"
                    }
                },
                "metas": {
                    "titles": {
                        "main": "إدارة المعلومات الوصفية",
                        "index": "عرض المعلومات الوصفية",
                        "create": "إنشاء معلومة وصفية",
                        "edit": "تعديل معلومة وصفية"
                    },
                    "actions": {
                        "destroy": "حذف المعلومات الوصفية المختارة"
                    }
                },
                "form_submissions": {
                    "titles": {
                        "main": "إدارة المرسَلات",
                        "index": "عرض المرسَلات",
                        "show": "تفاصل المُرسَل"
                    },
                    "actions": {
                        "destroy": "حذف المرسَلات المختارة"
                    }
                },
                "form_settings": {
                    "titles": {
                        "main": "إعدادات الإستمارة",
                        "index": "عرض إعدادات الإستمارة",
                        "create": "إنشاء إعداد إستمارة",
                        "edit": "تعديل إعداد إستمارة"
                    },
                    "descriptions": {
                        "recipients": "مثل: 'webmaster@example.com' أو 'sales@example.com,support@example.com' . لتحديد أكثر من مستقبل، يرجى فصلهم بفاصلة.",
                        "message": "الرسالة المراد عرضها للمستخدم بعد عملية إرسال معلومات الإستمارة. اتركها فارغة إذا لم ترد عرض أي رسالة"
                    }
                },
                "redirections": {
                    "titles": {
                        "main": "إدارة قواعد التوجيه",
                        "index": "عرض قواعد التوجيه",
                        "create": "إنشاء قاعدة توجيه",
                        "edit": "تعديل قاعدة توجيه"
                    },
                    "actions": {
                        "destroy": "حذف قواعد التوجيه المختارة",
                        "enable": "تفعيل قواعد التوجيه المختارة",
                        "disable": "إلغاء تفعيل قواعد التوجيه المختارة"
                    },
                    "types": {
                        "permanent": "إعادة توجيه دائم (301)",
                        "temporary": "إعادة توجيه مؤقت (302)"
                    },
                    "import": {
                        "title": "إستيراد ملف CSV",
                        "label": "إختر ملف CSV ليتم إستيراده",
                        "description": "الملف يجب أن يحوي عمودين بالترويسة \"source\" و \"target\" علماً أن إعادة التوجيه ستكون من النوع الدائم بشكل إفتراضي"
                    }
                },
                "posts": {
                    "statuses": {
                        "draft": "مسودة",
                        "pending": "معلّقة",
                        "published": "منشورة"
                    },
                    "titles": {
                        "main": "إدارة المقالات",
                        "index": "عرض المقالات",
                        "create": "إنشاء مقالة",
                        "edit": "تعديل مقالة",
                        "publication": "خيارات النشر"
                    },
                    "descriptions": {
                        "meta_title": "في حال كانت فارغة، فإن العنوان سيكون مطابق لعنوان المقالة بشكل إفتراضي",
                        "meta_description": "في حال كانت فارغة، فإن الوصف سيكون مطابق لملخص المقالة بشكل إفتراضي"
                    },
                    "placeholders": {
                        "body": "أكتب المحتوى...",
                        "meta_title": "عنوان المقالة.",
                        "meta_description": "ملخص المقالة."
                    },
                    "actions": {
                        "destroy": "حذف المقالات المختارة",
                        "publish": "نشر المقالات المختارة",
                        "pin": "تثبيت المقالات المختارة",
                        "promote": "ترقية المقالات المختارة"
                    }
                }
            },
            "frontend": {
                "titles": {
                    "home": "الرئيسية",
                    "about": "حول",
                    "contact": "إتصل بنا",
                    "blog": "المدونة",
                    "message_sent": "تم إرسال الرسالة",
                    "legal_mentions": "إشارات قانونية",
                    "administration": "إدارة"
                },
                "submissions": {
                    "message_sent": "<p>تم إرسال رسالتك بنجاح<\/p>"
                },
                "placeholders": {
                    "locale": "يرجى إختيار اللغة الخاصة بك",
                    "timezone": "يرجى إختيار النطاق الزمني الخاص بك"
                },
                "blog": {
                    "published_at": "نشرت بتاريخ {date}",
                    "published_at_with_owner_linkable": "نشرت بتاريخ {date} من قبل <a href=\"{link}\">{name}<\/a>",
                    "tags": "وسوم"
                }
            }
        },
        "logs": {
            "backend": {
                "users": {
                    "created": "تم إنشاء المستخدم {user}",
                    "updated": "تم تعديل المستخدم {user}",
                    "deleted": "تم حذف المستخدم {user}"
                },
                "form_submissions": {
                    "created": "تم إنشاء المرسَل {form_submission}"
                }
            },
            "frontend": []
        },
        "mails": {
            "layout": {
                "hello": "مرحباً !",
                "regards": "تحيات",
                "trouble": "إذا واجهت أي مشكلة بالضغط على الزر {action}، يرجى نسخ ولصق الرابط أدناه في المتصفح الخاص بك :",
                "all_rights_reserved": "جميع الحقوق محفوظة."
            },
            "password_reset": {
                "subject": "إعادة تعيين كلمة المرور",
                "intro": "تم إرسال هذا البريد الإلكتروني لأننا تلقينا طلب إعادة تعيين كلمة المرور للحساب الخاص بك",
                "action": "إعادة تعيين كلمة المرور",
                "outro": "إذا لم تطلب إعادة تعيين كلمة المرور، فلا داعي لاتخاذ أي إجراء"
            },
            "contact": {
                "subject": "رسالة إتصال جديدة",
                "new_contact": "لقد تلقيت رسالة إتصال جديدة. معلومات الإرسال :"
            },
            "alert": {
                "subject": "خطأ في [{app_name}]",
                "message": "لقد واجهت خطأ غير متوقع من طرف الخادم بالرسالة التالية : {message}.",
                "trace": "تفاصيل التقفي :"
            }
        },
        "pagination": {
            "previous": "&laquo; السابق",
            "next": "التالي &raquo;"
        },
        "passwords": {
            "password": "كلمة المرور يجب أن تحتوي على 6 أحرف على الأقل ومطابقة لتأكيدها.",
            "reset": "لقد تم إعادة تعيين كلمة مرورك!",
            "sent": "قمنا بإرسال رابط إعادة تعيين كلمة مرورك إلى بريدك الإلكتروني!",
            "token": "رمز إعادة تعيين كلمة المرور هذا غير صالح.",
            "user": "لم نستطع إيجاد مستخدم ينتمي إليه هذا البريد الإلكتروني."
        },
        "permissions": {
            "categories": {
                "blog": "المدونة",
                "form": "الاستمارات",
                "access": "الوصول",
                "seo": "تحسين أداء محركات البحث"
            },
            "access": {
                "backend": {
                    "display_name": "الوصول إلى لوحة الإدارة",
                    "description": "قادر على الوصول إلى صفحات الإدارة."
                }
            },
            "view": {
                "form_settings": {
                    "display_name": "مشاهدة إعدادات الاستمارات",
                    "description": "قادر على استعرض إعدادات الاستمارات."
                },
                "form_submissions": {
                    "display_name": "مشاهدة مرسَلات الاستمارات",
                    "description": "قادر على استعرض مرسَلات الاستمارات."
                },
                "users": {
                    "display_name": "مشاهدة المستخدمين",
                    "description": "قادر على استعرض المستخدمين."
                },
                "roles": {
                    "display_name": "مشاهدة الأدوار",
                    "description": "قادر على استعرض أدوار المستخدمين."
                },
                "metas": {
                    "display_name": "مشاهدة المعلومات الوصفية",
                    "description": "قادر على استعرض المعلومات الوصفية."
                },
                "redirections": {
                    "display_name": "مشاهدة قواعد إعادة التوجيه",
                    "description": "قادر على استعرض قواعد إعادة التوجيه."
                },
                "posts": {
                    "display_name": "مشاهدة جميع المقالات",
                    "description": "قادر على استعرض جميع المقالات."
                },
                "own": {
                    "posts": {
                        "display_name": "مشاهدة المقالات الخاصة بالمستخدم",
                        "description": "قادر على مشاهدة المقالات الخاصة به."
                    }
                }
            },
            "create": {
                "form_settings": {
                    "display_name": "إنشاء إعدادات الاستمارات",
                    "description": "قادر على إنشاء إعدادات الاستمارات."
                },
                "users": {
                    "display_name": "إنشاء مستخدمين",
                    "description": "قادر على إنشاء مستخدمين."
                },
                "roles": {
                    "display_name": "إضافة أدوار",
                    "description": "قادر على إضافة أدوار."
                },
                "metas": {
                    "display_name": "إضافة معلومات وصفية",
                    "description": "قادر على إضافة معلومات وصفية."
                },
                "redirections": {
                    "display_name": "إضافة قواعد توجيه",
                    "description": "قادر على إضافة قواعد توجيه."
                },
                "posts": {
                    "display_name": "إضافة مقالات",
                    "description": "قادر على إضافة مقالات."
                }
            },
            "edit": {
                "form_settings": {
                    "display_name": "تعديل إعدادات الاستمارات",
                    "description": "قادر على تعديل إعدادات الاستمارات."
                },
                "users": {
                    "display_name": "تعديل المستخدمين",
                    "description": "قادر على تعديل المستخدمين."
                },
                "roles": {
                    "display_name": "تعديل الأدوار",
                    "description": "قادر على تعديل المستخدمين."
                },
                "metas": {
                    "display_name": "تعديل المعلومات الوصفية",
                    "description": "قادر على تعديل المعلومات الوصفية."
                },
                "redirections": {
                    "display_name": "تعديل قواعد التوجيه",
                    "description": "قادر على تعديل قواعد التوجيه."
                },
                "posts": {
                    "display_name": "تعديل جميع المقالات",
                    "description": "قادر على تعديل جميع المقالات."
                },
                "own": {
                    "posts": {
                        "display_name": "تعديل مقالات المستخدم",
                        "description": "قادر على تعديل المقالات الخاصة به."
                    }
                }
            },
            "delete": {
                "form_settings": {
                    "display_name": "حذف إعدادات الاستمارات",
                    "description": "قادر على حذف إعدادات الاستمارات."
                },
                "form_submissions": {
                    "display_name": "حذف مرسلات الاستمارات",
                    "description": "قادر على حذف مرسلات الاستمارات."
                },
                "users": {
                    "display_name": "حذف المستخدمين",
                    "description": "قادر على حذف المستخدمين."
                },
                "roles": {
                    "display_name": "حذف الأدوار",
                    "description": "قادر على حذف الأدوار."
                },
                "metas": {
                    "display_name": "حذف المعلومات الوصفية",
                    "description": "قادر على حذف المعلومات الوصفية."
                },
                "redirections": {
                    "display_name": "حذف قواعد التوجيه",
                    "description": "قادر على حذف قواعد التوجيه."
                },
                "posts": {
                    "display_name": "حذف جميع المقالات",
                    "description": "قادر على حذف جميع المقالات."
                },
                "own": {
                    "posts": {
                        "display_name": "حذف مقالات المستخدم",
                        "description": "قادر على حذف المقالات الخاصة به."
                    }
                }
            },
            "publish": {
                "posts": {
                    "display_name": "نشر المقالات",
                    "description": "قادر على إدارة عملية نشر المقالات."
                }
            },
            "impersonate": {
                "display_name": "إنتحال شخصية مستخدم",
                "description": "قادر على أخذ صلاحيات مستخدم أخر، خاص بحالات التجريب."
            }
        },
        "routes": {
            "home": "الرئيسية",
            "about": "حول",
            "contact": "اتصل-بنا",
            "contact-sent": "تم-الإرسال",
            "legal-mentions": "إشارات-قانونية",
            "redactors": "blog\/redactors\/{user}"
        },
        "validation": {
            "accepted": "يجب قبول الحقل {attribute}.",
            "active_url": "الحقل {attribute} لا يُمثّل رابطًا صحيحًا.",
            "after": "يجب على الحقل {attribute} أن يكون تاريخًا لاحقًا للتاريخ {date}.",
            "after_or_equal": "يجب على الحقل {attribute} أن يكون تاريخًا مساوٍ أو لاحقًا للتاريخ {date}.",
            "alpha": "يجب أن لا يحتوي الحقل {attribute} سوى على حروف.",
            "alpha_dash": "يجب أن لا يحتوي الحقل {attribute} على حروف، أرقام ومطّات.",
            "alpha_num": "يجب أن يحتوي {attribute} على حروف وأرقام فقط.",
            "array": "يجب أن يكون الحقل {attribute} ًمصفوفة.",
            "before": "يجب على الحقل {attribute} أن يكون تاريخًا سابقًا للتاريخ {date}.",
            "before_or_equal": "يجب على الحقل {attribute} أن يكون تاريخًا سابقًا أو مساوٍ للتاريخ {date}.",
            "between": {
                "numeric": "يجب أن تكون قيمة {attribute} محصورة ما بين {min} و {max}.",
                "file": "يجب أن يكون حجم الملف {attribute} محصورًا ما بين {min} و {max} كيلوبايت.",
                "string": "يجب أن يكون عدد حروف النّص {attribute} محصورًا ما بين {min} و {max}.",
                "array": "يجب أن يحتوي {attribute} على عدد من العناصر محصورًا ما بين {min} و {max}."
            },
            "boolean": "يجب أن تكون قيمة الحقل {attribute} إما true أو false.",
            "confirmed": "حقل التأكيد غير مُطابق للحقل {attribute}.",
            "date": "الحقل {attribute} ليس تاريخًا صحيحاً.",
            "date_format": "لا يتوافق الحقل {attribute} مع الشكل {format}.",
            "different": "يجب أن يكون الحقلان {attribute} و {other} مُختلفان.",
            "digits": "يجب أن يحتوي الحقل {attribute} على {digits} رقمًا\/أرقام.",
            "digits_between": "يجب أن يحتوي الحقل {attribute} ما بين {min} و {max} رقمًا\/أرقام.",
            "dimensions": " أبعاد الصورة {attribute} غير صالحة.",
            "distinct": "للحقل {attribute} قيمة مُكرّرة.",
            "email": "يجب أن يكون {attribute} عنوان بريد إلكتروني صحيح البُنية.",
            "exists": "الحقل {attribute} لاغٍ.",
            "file": "الحقل {attribute} يجب أن يكون ملف.",
            "filled": "الحقل {attribute} إجباري.",
            "image": "يجب أن يكون الحقل {attribute} صورة.",
            "in": "الحقل {attribute} لاغٍ.",
            "in_array": "الحقل {attribute} غير موجود في {other}.",
            "integer": "يجب أن يكون الحقل {attribute} عدد صحيح.",
            "ip": "يجب أن يكون الحقل {attribute} عنوان IP ذي بُنية صحيحة.",
            "ipv4": "يجب أن يكون الحقل {attribute} عنوان IPv4 ذي بُنية صحيحة.",
            "ipv6": "يجب أن يكون الحقل {attribute} عنوان IPv6 ذي بُنية صحيحة.",
            "json": "يجب أن يكون الحقل {attribute} نصآ من نوع JSON.",
            "max": {
                "numeric": "يجب أن تكون قيمة الحقل {attribute} أصغر من {max}.",
                "file": "يجب أن يكون حجم الملف {attribute} أصغر من {max} كيلوبايت.",
                "string": "يجب أن لا يتجاوز طول النّص {attribute} {max} حروفٍ\/حرفًا.",
                "array": "يجب أن لا يحتوي الحقل {attribute} على أكثر من {max} عناصر\/عنصر."
            },
            "mimes": "يجب أن يكون الحقل ملفًا من نوع : {values}.",
            "mimetypes": "يجب أن يكون الحقل ملفًا من نوع : {values}.",
            "min": {
                "numeric": "يجب أن تكون قيمة الحقل {attribute} أكبر من {min}.",
                "file": "يجب أن يكون حجم الملف {attribute} أكبر من {min} كيلوبايت.",
                "string": "يجب أن يكون طول النص {attribute} أكبر من {min} حروفٍ\/حرفًا.",
                "array": "يجب أن يحتوي الحقل {attribute} على الأقل على {min} عُنصرًا\/عناصر."
            },
            "not_in": "الحقل {attribute} لاغٍ.",
            "numeric": "يجب على الحقل {attribute} أن يكون رقماً.",
            "present": "الحقل {attribute} يجب أن يكون موجوداً.",
            "regex": "صيغة الحقل {attribute} غير صحيحة.",
            "required": "الحقل {attribute} مطلوب.",
            "required_if": "الحقل {attribute} مطلوب في حال ما إذا كان {other} يساوي {value}.",
            "required_unless": "الحقل {attribute} مطلوب في حال ما لم يكن {other} يساوي {values}.",
            "required_with": "الحقل {attribute} مطلوب إذا توفّر {values}.",
            "required_with_all": "الحقل {attribute} مطلوب إذا توفّر {values}.",
            "required_without": "الحقل {attribute} مطلوب إذا لم يتوفّر {values}.",
            "required_without_all": "الحقل {attribute} مطلوب إذا لم يتوفّر {values}.",
            "same": "يجب أن يتطابق الحقل {attribute} مع {other}",
            "size": {
                "numeric": "يجب أن تكون قيمة {attribute} أكبر من {size}.",
                "file": "يجب أن يكون حجم الملف {attribute} أكبر من {size} كيلو بايت.",
                "string": "يجب أن يحتوي النص {attribute} عن ما لا يقل عن  {size} حرفٍ\/أحرف.",
                "array": "يجب أن يحتوي الحقل {attribute} عن ما لا يقل عن{min} عنصرٍ\/عناصر."
            },
            "string": "يجب أن يكون الحقل {attribute} نصآ.",
            "timezone": "يجب أن يكون {attribute} نطاقًا زمنيًا صحيحًا",
            "unique": "قيمة الحقل {attribute} مُستخدمة من قبل.",
            "uploaded": "فشل في تحميل {attribute}.",
            "url": "صيغة الرابط {attribute} غير صحيحة.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "الاسم",
                "display_name": "اسم العرض",
                "username": "اسم المستخدم",
                "email": "عنوان البريد الإلكتروني",
                "first_name": "الاسم الأول",
                "last_name": "الاسم الأخير",
                "password": "كلمة المرور",
                "password_confirmation": "تأكيد كلمة المرور",
                "old_password": "كلمة المرور القديمة",
                "new_password": "كلمة المرور الجديدة",
                "new_password_confirmation": "تأكيد كلمة المرور الجديدة",
                "postal_code": "الرمز البريدي",
                "city": "المدينة",
                "country": "الدولة",
                "address": "العنوان",
                "phone": "الهاتف",
                "mobile": "المحمول",
                "age": "العمر",
                "sex": "الجنس",
                "gender": "الجنس",
                "day": "اليوم",
                "month": "الشهر",
                "year": "السنة",
                "hour": "الساعة",
                "minute": "الدقيقة",
                "second": "الثانية",
                "title": "العنوان",
                "content": "المحتوى",
                "description": "الوصف",
                "summary": "الملخص",
                "excerpt": "مقتطفات",
                "date": "التاريخ",
                "time": "الوقت",
                "available": "متوفر",
                "size": "الحجم",
                "roles": "الأدوار",
                "permissions": "الصلاحيات",
                "active": "فعال",
                "message": "رسالة",
                "g-recaptcha-response": "رمز حماية Captcha",
                "locale": "تعريب",
                "route": "توجيه",
                "url": "اسم الرابط المستعار",
                "form_type": "نوع الإستمارة",
                "form_data": "معلومات الإستمارة",
                "recipients": "المستلمين",
                "source_path": "المسار الأصلي",
                "target_path": "المسار الهدف",
                "redirect_type": "نوع التوجيه",
                "timezone": "نطاق زمني",
                "order": "ترتيب العرض",
                "image": "صورة",
                "status": "حالة",
                "pinned": "مثبت",
                "promoted": "مُرقّى",
                "body": "جسم",
                "tags": "وسوم",
                "published_at": "منشور في",
                "unpublished_at": "إيقاف النشر في",
                "metable_type": "كيان"
            }
        }
    },
    "en": {
        "alerts": {
            "backend": {
                "users": {
                    "created": "User created",
                    "updated": "User updated",
                    "deleted": "User deleted",
                    "bulk_destroyed": "Selected users deleted",
                    "bulk_enabled": "Selected users enabled",
                    "bulk_disabled": "Selected users disabled"
                },
                "roles": {
                    "created": "Role created",
                    "updated": "Role updated",
                    "deleted": "Role deleted"
                },
                "metas": {
                    "created": "Meta created",
                    "updated": "Meta updated",
                    "deleted": "Meta deleted",
                    "bulk_destroyed": "Selected metas deleted"
                },
                "form_submissions": {
                    "deleted": "Submission deleted",
                    "bulk_destroyed": "Selected submissions deleted"
                },
                "form_settings": {
                    "created": "Form setting created",
                    "updated": "Form setting updated",
                    "deleted": "Form setting deleted"
                },
                "redirections": {
                    "created": "Redirection created",
                    "updated": "Redirection updated",
                    "deleted": "Redirection deleted",
                    "bulk_destroyed": "Selected redirections deleted",
                    "bulk_enabled": "Selected redirections enabled",
                    "bulk_disabled": "Selected redirections disabled",
                    "file_imported": "File successfully imported"
                },
                "posts": {
                    "created": "Post created",
                    "updated": "Post updated",
                    "deleted": "Post deleted",
                    "bulk_destroyed": "Selected posts deleted",
                    "bulk_published": "Selected posts published",
                    "bulk_pending": "Selected posts are awaiting moderation",
                    "bulk_pinned": "Selected posts pinned",
                    "bulk_promoted": "Selected posts promoted"
                },
                "actions": {
                    "invalid": "Invalid action"
                }
            },
            "frontend": []
        },
        "auth": {
            "failed": "These credentials do not match our records.",
            "throttle": "Too many login attempts. Please try again in {seconds} seconds.",
            "socialite": {
                "unacceptable": "{provider} is not an acceptable login type."
            }
        },
        "buttons": {
            "cancel": "Cancel",
            "save": "Save",
            "close": "Close",
            "create": "Create",
            "delete": "Delete",
            "confirm": "Confirm",
            "show": "Show",
            "edit": "Edit",
            "update": "Update",
            "view": "View",
            "preview": "Preview",
            "back": "Back",
            "send": "Send",
            "login-as": "Login as {name}",
            "apply": "Apply",
            "users": {
                "create": "Create user"
            },
            "roles": {
                "create": "Create role"
            },
            "metas": {
                "create": "Create meta"
            },
            "form_settings": {
                "create": "Create setting"
            },
            "redirections": {
                "create": "Create redirection",
                "import": "Import CSV"
            },
            "posts": {
                "create": "Create post",
                "save_and_publish": "Save and publish",
                "save_as_draft": "Save as draft"
            }
        },
        "exceptions": {
            "general": "Server exception",
            "unauthorized": "Action not allowed",
            "backend": {
                "users": {
                    "create": "Error on user creation",
                    "update": "Error on user updating",
                    "delete": "Error on user deletion",
                    "first_user_cannot_be_edited": "You cannot edit super admin user",
                    "first_user_cannot_be_disabled": "Super admin user cannot be disabled",
                    "first_user_cannot_be_destroyed": "Super admin user cannot be deleted",
                    "first_user_cannot_be_impersonated": "Super admin user cannot be impersonated",
                    "cannot_set_superior_roles": "You cannot attribute roles superior to yours"
                },
                "roles": {
                    "create": "Error on role creation",
                    "update": "Error on role updating",
                    "delete": "Error on role deletion"
                },
                "metas": {
                    "create": "Error on meta creation",
                    "update": "Error on meta updating",
                    "delete": "Error on meta deletion",
                    "already_exist": "There is already a meta for this locale route"
                },
                "form_submissions": {
                    "create": "Error on submission creation",
                    "delete": "Error on submission deletion"
                },
                "form_settings": {
                    "create": "Error on form setting creation",
                    "update": "Error on form setting updating",
                    "delete": "Error on form setting deletion",
                    "already_exist": "There is already a setting linked to this form"
                },
                "redirections": {
                    "create": "Error on redirection creation",
                    "update": "Error on redirection updating",
                    "delete": "Error on redirection deletion",
                    "already_exist": "There is already a redirection for this path"
                },
                "posts": {
                    "create": "Error on post creation",
                    "update": "Error on post updating",
                    "save": "Error on post saving",
                    "delete": "Error on post deletion"
                }
            },
            "frontend": {
                "user": {
                    "email_taken": "That e-mail address is already taken.",
                    "password_mismatch": "That is not your old password.",
                    "delete_account": "Error on account deletion.",
                    "updating_disabled": "Account editing is disabled."
                },
                "auth": {
                    "registration_disabled": "Registration is disabled."
                }
            }
        },
        "forms": {
            "contact": {
                "display_name": "Contact form"
            }
        },
        "labels": {
            "language": "Language",
            "actions": "Actions",
            "general": "General",
            "no_results": "No results available",
            "search": "Search",
            "validate": "Validate",
            "choose_file": "Choose File",
            "no_file_chosen": "No file chosen",
            "are_you_sure": "Are you sure ?",
            "delete_image": "Delete image",
            "yes": "Yes",
            "no": "No",
            "add_new": "Add",
            "export": "Export",
            "more_info": "More info",
            "author": "Author",
            "author_id": "Author ID",
            "last_access_at": "Last access at",
            "published_at": "Published at",
            "created_at": "Created at",
            "updated_at": "Updated at",
            "deleted_at": "Deleted at",
            "no_value": "No value",
            "upload_image": "Upload image",
            "anonymous": "Anonymous",
            "all_rights_reserved": "All rights reserved.",
            "with": "with",
            "by": "by",
            "datatables": {
                "no_results": "No results available",
                "no_matched_results": "No matched results available",
                "show_per_page": "Show",
                "entries_per_page": "entries per page",
                "search": "Search",
                "infos": "Showing {offset_start} to {offset_end} of {total} entries"
            },
            "morphs": {
                "post": "Post, identity {id}",
                "user": "User, identity {id}"
            },
            "auth": {
                "disabled": "Your account has been disabled."
            },
            "http": {
                "403": {
                    "title": "Access Denied",
                    "description": "Sorry, but you do not have permissions to access this page."
                },
                "404": {
                    "title": "Page Not Found",
                    "description": "Sorry, but the page you were trying to view does not exist."
                },
                "500": {
                    "title": "Server Error",
                    "description": "Sorry, but the server has encountered a situation it doesn't know how to handle. We'll fix this as soon as possible."
                }
            },
            "localization": {
                "en": "English",
                "ru": "Russian",
                "fr": "French",
                "es": "Spanish",
                "de": "German",
                "zh": "Chinese",
                "ar": "Arab",
                "pt": "Portuguese"
            },
            "placeholders": {
                "route": "Select a valid internal route",
                "tags": "Select or create a tag"
            },
            "cookieconsent": {
                "message": "This website uses cookies to ensure you get the best experience on our website.",
                "dismiss": "Got it !"
            },
            "descriptions": {
                "allowed_image_types": "Allowed types: png gif jpg jpeg."
            },
            "user": {
                "dashboard": "Dashboard",
                "remember": "Remember",
                "login": "Login",
                "logout": "Logout",
                "password_forgot": "Forget password ?",
                "send_password_link": "Send reset password link",
                "password_reset": "Password Reset",
                "register": "Register",
                "space": "My space",
                "settings": "Settings",
                "account": "My account",
                "profile": "My profile",
                "avatar": "Avatar",
                "online": "Online",
                "edit_profile": "Edit my profile",
                "change_password": "Change my password",
                "delete": "Delete my account",
                "administration": "Administration",
                "member_since": "Member since {date}",
                "profile_updated": "Profile successfully updated.",
                "password_updated": "Password successfully updated.",
                "super_admin": "Super administrator",
                "account_delete": "<p>This action will delete entirely your account from this site as well as all associated data.<\/p>",
                "account_deleted": "Account successfully deleted",
                "titles": {
                    "space": "My space",
                    "account": "My account"
                }
            },
            "alerts": {
                "login_as": "You are actually logged as <strong>{name}<\/strong>, you can logout as <a href=\"{route}\" data-turbolinks=\"false\">{admin}<\/a>."
            },
            "backend": {
                "dashboard": {
                    "new_posts": "New posts",
                    "pending_posts": "Pending posts",
                    "published_posts": "Published posts",
                    "active_users": "Active users",
                    "form_submissions": "Submissions",
                    "last_posts": "Last posts",
                    "last_published_posts": "Last publications",
                    "last_pending_posts": "Last pending posts",
                    "last_new_posts": "Last new posts",
                    "all_posts": "All posts"
                },
                "new_menu": {
                    "post": "New post",
                    "form_setting": "New form setting",
                    "user": "New user",
                    "role": "New role",
                    "meta": "New meta",
                    "redirection": "New redirection"
                },
                "sidebar": {
                    "content": "Content management",
                    "forms": "Form management",
                    "access": "Access management",
                    "seo": "SEO settings"
                },
                "titles": {
                    "dashboard": "Dashboard"
                },
                "users": {
                    "titles": {
                        "main": "User",
                        "index": "User list",
                        "create": "User creation",
                        "edit": "User modification"
                    },
                    "actions": {
                        "destroy": "Delete selected users",
                        "enable": "Enable selected users",
                        "disable": "Disable selected users"
                    }
                },
                "roles": {
                    "titles": {
                        "main": "Role",
                        "index": "Role list",
                        "create": "Role creation",
                        "edit": "Role modification"
                    }
                },
                "metas": {
                    "titles": {
                        "main": "Meta",
                        "index": "Meta list",
                        "create": "Meta creation",
                        "edit": "Meta modification"
                    },
                    "actions": {
                        "destroy": "Delete selected metas"
                    }
                },
                "form_submissions": {
                    "titles": {
                        "main": "Submission",
                        "index": "Submission list",
                        "show": "Submission detail"
                    },
                    "actions": {
                        "destroy": "Delete selected submissions"
                    }
                },
                "form_settings": {
                    "titles": {
                        "main": "Forms",
                        "index": "Form setting list",
                        "create": "Form setting creation",
                        "edit": "Form setting modification"
                    },
                    "descriptions": {
                        "recipients": "Example: 'webmaster@example.com' or 'sales@example.com,support@example.com' . To specify multiple recipients, separate each email address with a comma.",
                        "message": "The message to display to the user after submission of this form. Leave blank for no message."
                    }
                },
                "redirections": {
                    "titles": {
                        "main": "Redirection",
                        "index": "Redirection list",
                        "create": "Redirection creation",
                        "edit": "Redirection modification"
                    },
                    "actions": {
                        "destroy": "Delete selected redirections",
                        "enable": "Enable selected redirections",
                        "disable": "Disable selected redirections"
                    },
                    "types": {
                        "permanent": "Permanent redirect (301)",
                        "temporary": "Temporary redirect (302)"
                    },
                    "import": {
                        "title": "CSV file import",
                        "label": "Select CSV file to import",
                        "description": "File must have 2 columns with \"source\" and \"target\" as heading, redirection will be permanent by default"
                    }
                },
                "posts": {
                    "statuses": {
                        "draft": "Draft",
                        "pending": "Pending",
                        "published": "Published"
                    },
                    "titles": {
                        "main": "Posts",
                        "index": "Post list",
                        "create": "Create post",
                        "edit": "Edit post",
                        "publication": "Publication options"
                    },
                    "descriptions": {
                        "meta_title": "If leave empty, title will be that of article' title by default.",
                        "meta_description": "If leave empty, description will be that of article's summary by default."
                    },
                    "placeholders": {
                        "body": "Write your content...",
                        "meta_title": "Article's title.",
                        "meta_description": "Article's summary."
                    },
                    "actions": {
                        "destroy": "Delete selected posts",
                        "publish": "Publish selected posts",
                        "pin": "Pin selected posts",
                        "promote": "Promote selected posts"
                    }
                }
            },
            "frontend": {
                "titles": {
                    "home": "Home",
                    "about": "About",
                    "contact": "Contact",
                    "blog": "Blog",
                    "message_sent": "Message sent",
                    "legal_mentions": "Legal mentions",
                    "administration": "Administration"
                },
                "submissions": {
                    "message_sent": "<p>Your message has been successfully sent<\/p>"
                },
                "placeholders": {
                    "locale": "Select your language",
                    "timezone": "Select your timezone"
                },
                "blog": {
                    "published_at": "Published at {date}",
                    "published_at_with_owner_linkable": "Published at {date} by <a href=\"{link}\">{name}<\/a>",
                    "tags": "Tags"
                }
            }
        },
        "logs": {
            "backend": {
                "users": {
                    "created": "User ID {user} created",
                    "updated": "User ID {user} updated",
                    "deleted": "User ID {user} deleted"
                },
                "form_submissions": {
                    "created": "Form submission ID {form_submission} created"
                }
            },
            "frontend": []
        },
        "mails": {
            "layout": {
                "hello": "Hello !",
                "regards": "Regards",
                "trouble": "If you’re having trouble clicking the {action} button, copy and paste the URL below into your web browser :",
                "all_rights_reserved": "All rights reserved."
            },
            "password_reset": {
                "subject": "Password reset",
                "intro": "You are receiving this email because we received a password reset request for your account.",
                "action": "Reset Password",
                "outro": "If you did not request a password reset, no further action is required."
            },
            "contact": {
                "subject": "New contact message",
                "new_contact": "You've got a new contact message. Submission detail :"
            },
            "alert": {
                "subject": "[{app_name}] Exception error",
                "message": "You've got unexpected server exception error which message is : {message}.",
                "trace": "All trace detail :"
            }
        },
        "pagination": {
            "previous": "&laquo; Previous",
            "next": "Next &raquo;"
        },
        "passwords": {
            "password": "Passwords must be at least six characters and match the confirmation.",
            "reset": "Your password has been reset!",
            "sent": "We have e-mailed your password reset link!",
            "token": "This password reset token is invalid.",
            "user": "We can't find a user with that e-mail address."
        },
        "permissions": {
            "categories": {
                "blog": "Blog",
                "form": "Forms",
                "access": "Access",
                "seo": "SEO"
            },
            "access": {
                "backend": {
                    "display_name": "Backoffice access",
                    "description": "Can access to administration pages."
                }
            },
            "view": {
                "form_settings": {
                    "display_name": "View form settings",
                    "description": "Can view form settings."
                },
                "form_submissions": {
                    "display_name": "View form submissions",
                    "description": "Can view form submissions."
                },
                "users": {
                    "display_name": "View users",
                    "description": "Can view users."
                },
                "roles": {
                    "display_name": "View roles",
                    "description": "Can view roles."
                },
                "metas": {
                    "display_name": "View metas",
                    "description": "Can view metas."
                },
                "redirections": {
                    "display_name": "View redirections",
                    "description": "Can view redirections."
                },
                "posts": {
                    "display_name": "View all posts",
                    "description": "Can view all posts."
                },
                "own": {
                    "posts": {
                        "display_name": "View own posts",
                        "description": "Can view own posts."
                    }
                }
            },
            "create": {
                "form_settings": {
                    "display_name": "Create form settings",
                    "description": "Can create form settings."
                },
                "users": {
                    "display_name": "Create users",
                    "description": "Can create users."
                },
                "roles": {
                    "display_name": "Create roles",
                    "description": "Can create roles."
                },
                "metas": {
                    "display_name": "Create metas",
                    "description": "Can create metas."
                },
                "redirections": {
                    "display_name": "Create redirections",
                    "description": "Can create redirections."
                },
                "posts": {
                    "display_name": "Create posts",
                    "description": "Can create all posts."
                }
            },
            "edit": {
                "form_settings": {
                    "display_name": "Edit form settings",
                    "description": "Can edit form settings."
                },
                "users": {
                    "display_name": "Edit users",
                    "description": "Can edit users."
                },
                "roles": {
                    "display_name": "Edit roles",
                    "description": "Can edit roles."
                },
                "metas": {
                    "display_name": "Edit metas",
                    "description": "Can edit metas."
                },
                "redirections": {
                    "display_name": "Edit redirections",
                    "description": "Can edit redirections."
                },
                "posts": {
                    "display_name": "Edit all posts",
                    "description": "Can edit all posts."
                },
                "own": {
                    "posts": {
                        "display_name": "Edit own posts",
                        "description": "Can edit own posts."
                    }
                }
            },
            "delete": {
                "form_settings": {
                    "display_name": "Delete form settings",
                    "description": "Can delete form settings."
                },
                "form_submissions": {
                    "display_name": "Delete form submissions",
                    "description": "Can delete form submissions."
                },
                "users": {
                    "display_name": "Delete users",
                    "description": "Can delete users."
                },
                "roles": {
                    "display_name": "Delete roles",
                    "description": "Can delete roles."
                },
                "metas": {
                    "display_name": "Delete metas",
                    "description": "Can delete metas."
                },
                "redirections": {
                    "display_name": "Delete redirections",
                    "description": "Can delete redirections."
                },
                "posts": {
                    "display_name": "Delete all posts",
                    "description": "Can delete all posts."
                },
                "own": {
                    "posts": {
                        "display_name": "Delete own posts",
                        "description": "Can delete own posts."
                    }
                }
            },
            "publish": {
                "posts": {
                    "display_name": "Publish posts",
                    "description": "Can manage posts publication."
                }
            },
            "impersonate": {
                "display_name": "Impersonate user",
                "description": "Can take ownership of others user identities. Useful for tests."
            }
        },
        "routes": {
            "home": "home",
            "about": "about",
            "contact": "contact",
            "contact-sent": "contact-sent",
            "legal-mentions": "legal-mentions",
            "redactors": "blog\/redactors\/{user}"
        },
        "validation": {
            "accepted": "The {attribute} must be accepted.",
            "active_url": "The {attribute} is not a valid URL.",
            "after": "The {attribute} must be a date after {date}.",
            "after_or_equal": "The {attribute} must be a date after or equal to {date}.",
            "alpha": "The {attribute} may only contain letters.",
            "alpha_dash": "The {attribute} may only contain letters, numbers, and dashes.",
            "alpha_num": "The {attribute} may only contain letters and numbers.",
            "array": "The {attribute} must be an array.",
            "before": "The {attribute} must be a date before {date}.",
            "before_or_equal": "The {attribute} must be a date before or equal to {date}.",
            "between": {
                "numeric": "The {attribute} must be between {min} and {max}.",
                "file": "The {attribute} must be between {min} and {max} kilobytes.",
                "string": "The {attribute} must be between {min} and {max} characters.",
                "array": "The {attribute} must have between {min} and {max} items."
            },
            "boolean": "The {attribute} field must be true or false.",
            "confirmed": "The {attribute} confirmation does not match.",
            "date": "The {attribute} is not a valid date.",
            "date_format": "The {attribute} does not match the format {format}.",
            "different": "The {attribute} and {other} must be different.",
            "digits": "The {attribute} must be {digits} digits.",
            "digits_between": "The {attribute} must be between {min} and {max} digits.",
            "dimensions": "The {attribute} has invalid image dimensions.",
            "distinct": "The {attribute} field has a duplicate value.",
            "email": "The {attribute} must be a valid email address.",
            "exists": "The selected {attribute} is invalid.",
            "file": "The {attribute} must be a file.",
            "filled": "The {attribute} field must have a value.",
            "image": "The {attribute} must be an image.",
            "in": "The selected {attribute} is invalid.",
            "in_array": "The {attribute} field does not exist in {other}.",
            "integer": "The {attribute} must be an integer.",
            "ip": "The {attribute} must be a valid IP address.",
            "ipv4": "The {attribute} must be a valid IPv4 address.",
            "ipv6": "The {attribute} must be a valid IPv6 address.",
            "json": "The {attribute} must be a valid JSON string.",
            "max": {
                "numeric": "The {attribute} may not be greater than {max}.",
                "file": "The {attribute} may not be greater than {max} kilobytes.",
                "string": "The {attribute} may not be greater than {max} characters.",
                "array": "The {attribute} may not have more than {max} items."
            },
            "mimes": "The {attribute} must be a file of type: {values}.",
            "mimetypes": "The {attribute} must be a file of type: {values}.",
            "min": {
                "numeric": "The {attribute} must be at least {min}.",
                "file": "The {attribute} must be at least {min} kilobytes.",
                "string": "The {attribute} must be at least {min} characters.",
                "array": "The {attribute} must have at least {min} items."
            },
            "not_in": "The selected {attribute} is invalid.",
            "not_regex": "The {attribute} format is invalid.",
            "numeric": "The {attribute} must be a number.",
            "present": "The {attribute} field must be present.",
            "regex": "The {attribute} format is invalid.",
            "required": "The {attribute} field is required.",
            "required_if": "The {attribute} field is required when {other} is {value}.",
            "required_unless": "The {attribute} field is required unless {other} is in {values}.",
            "required_with": "The {attribute} field is required when {values} is present.",
            "required_with_all": "The {attribute} field is required when {values} is present.",
            "required_without": "The {attribute} field is required when {values} is not present.",
            "required_without_all": "The {attribute} field is required when none of {values} are present.",
            "same": "The {attribute} and {other} must match.",
            "size": {
                "numeric": "The {attribute} must be {size}.",
                "file": "The {attribute} must be {size} kilobytes.",
                "string": "The {attribute} must be {size} characters.",
                "array": "The {attribute} must contain {size} items."
            },
            "string": "The {attribute} must be a string.",
            "timezone": "The {attribute} must be a valid zone.",
            "unique": "The {attribute} has already been taken.",
            "uploaded": "The {attribute} failed to upload.",
            "url": "The {attribute} format is invalid.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "Name",
                "display_name": "Display name",
                "username": "Pseudo",
                "email": "Email",
                "first_name": "Firstname",
                "last_name": "Lastname",
                "password": "Password",
                "password_confirmation": "Confirm password",
                "old_password": "Old password",
                "new_password": "New password",
                "new_password_confirmation": "Confirm new password",
                "postal_code": "Postal code",
                "city": "City",
                "country": "Country",
                "address": "Address",
                "phone": "Phone",
                "mobile": "Mobile",
                "age": "Age",
                "sex": "Sex",
                "gender": "Gender",
                "day": "Day",
                "month": "Month",
                "year": "Year",
                "hour": "Hour",
                "minute": "Minute",
                "second": "Second",
                "title": "Title",
                "content": "Content",
                "description": "Description",
                "summary": "Summary",
                "excerpt": "Excerpt",
                "date": "Date",
                "time": "Time",
                "available": "Available",
                "size": "Size",
                "roles": "Roles",
                "permissions": "Permissions",
                "active": "Active",
                "message": "Message",
                "g-recaptcha-response": "Captcha",
                "locale": "Localization",
                "route": "Route",
                "url": "URL alias",
                "form_type": "Form type",
                "form_data": "Form data",
                "recipients": "Recipients",
                "source_path": "Original path",
                "target_path": "Target path",
                "redirect_type": "Redirect type",
                "timezone": "Timezone",
                "order": "Display order",
                "image": "Image",
                "status": "Status",
                "pinned": "Pinned",
                "promoted": "Promoted",
                "body": "Body",
                "tags": "Tags",
                "published_at": "Publish at",
                "unpublished_at": "Unpublish at",
                "metable_type": "Entity"
            }
        }
    },
    "es": {
        "alerts": {
            "backend": {
                "users": {
                    "created": "Usuario creado",
                    "updated": "Usuario actualizado",
                    "deleted": "Usuario eliminado",
                    "bulk_destroyed": "Usuarios seleccionados eliminados",
                    "bulk_enabled": "Usuarios seleccionados habilitados",
                    "bulk_disabled": "Usuarios seleccionados deshabilitados"
                },
                "roles": {
                    "created": "Rol creado",
                    "updated": "Rol actualizado",
                    "deleted": "Rol eliminado"
                },
                "metas": {
                    "created": "Meta creado",
                    "updated": "Meta actualizado",
                    "deleted": "Meta eliminado",
                    "bulk_destroyed": "Metas seleccionadas eliminadas"
                },
                "form_submissions": {
                    "deleted": "Solicitud eliminada",
                    "bulk_destroyed": "Solicitudes seleccionadas eliminadas"
                },
                "form_settings": {
                    "created": "Configuración de formulario creada",
                    "updated": "Configuración de formulario actualizada",
                    "deleted": "Configuración de formulario eliminada"
                },
                "redirections": {
                    "created": "Redirección creada",
                    "updated": "Redirección actualizada",
                    "deleted": "Redirección eliminada",
                    "bulk_destroyed": "Redirecciones seleccionadas eliminadas",
                    "bulk_enabled": "Redirecciones seleccionadas habilitadas",
                    "bulk_disabled": "Redirecciones seleccionadas deshabilitadas",
                    "file_imported": "Archivo importado con éxito"
                },
                "posts": {
                    "created": "Articulo creado",
                    "updated": "Articulo actualizado",
                    "deleted": "Articulo eliminado",
                    "bulk_destroyed": "Artículos seleccionados eliminados",
                    "bulk_published": "Artículos seleccionados publicados",
                    "bulk_pending": "Los artículos seleccionados esperan moderación",
                    "bulk_pinned": "Los artículos seleccionados fijadas",
                    "bulk_promoted": "Los artículos seleccionados promocionados"
                },
                "actions": {
                    "invalid": "Acción no válida"
                }
            },
            "frontend": []
        },
        "auth": {
            "failed": "Estas credenciales no coinciden con nuestros registros.",
            "throttle": "Demasiados intentos de inicio de sesión. "
        },
        "buttons": {
            "cancel": "Cancelar",
            "save": "Salvar",
            "close": "Cerrar",
            "create": "Crear",
            "delete": "Borrar",
            "confirm": "Confirmar",
            "show": "Mostrar",
            "edit": "Editar",
            "update": "Actualizar",
            "view": "Ver",
            "preview": "Previsualizar",
            "back": "Atras",
            "send": "Enviar",
            "login-as": "Iniciar como {name}",
            "apply": "Aplicar",
            "users": {
                "create": "Crear usuario"
            },
            "roles": {
                "create": "Crear rol"
            },
            "metas": {
                "create": "Crear meta"
            },
            "form_settings": {
                "create": "Crear configuración"
            },
            "redirections": {
                "create": "Crear redirección",
                "import": "Importar CSV"
            },
            "posts": {
                "create": "Crear publicación",
                "save_and_publish": "Guardar y publicar",
                "save_as_draft": "Guardar como borrador"
            }
        },
        "exceptions": {
            "general": "Excepción del servidor",
            "unauthorized": "Acción no permitida",
            "backend": {
                "users": {
                    "create": "Error en la creación del usuario",
                    "update": "Error en la actualización del usuario",
                    "delete": "Error en la eliminación del usuario",
                    "first_user_cannot_be_edited": "No puedes editar el usuario súper administrador",
                    "first_user_cannot_be_disabled": "El usuario súper administrador no puede ser deshabilitado",
                    "first_user_cannot_be_destroyed": "El usuario súper administrador no puede ser eliminado",
                    "first_user_cannot_be_impersonated": "El usuario Super administrador no puede ser suplantado",
                    "cannot_set_superior_roles": "No puedes atribuir roles superiores a los tuyos"
                },
                "roles": {
                    "create": "Error en la creación de roles",
                    "update": "Error en la actualización de roles",
                    "delete": "Error en la eliminación de roles"
                },
                "metas": {
                    "create": "Error en la creación de la meta",
                    "update": "Error en la actualización de la meta",
                    "delete": "Error en la eliminación de la meta",
                    "already_exist": "Ya hay una meta para esta ruta de configuración regional"
                },
                "form_submissions": {
                    "create": "Error en la creación de la solicitud",
                    "delete": "Error en la eliminación de la solicitud"
                },
                "form_settings": {
                    "create": "Error en la creación de configuración de formulario",
                    "update": "Error en la actualización de configuración del formulario",
                    "delete": "Error en la eliminación de configuración del formulario",
                    "already_exist": "Ya hay una configuración vinculada a este formulario"
                },
                "redirections": {
                    "create": "Error en la creación de la redirección",
                    "update": "Error en la actualización de la redirección",
                    "delete": "Error en la eliminación de la redirección",
                    "already_exist": "Ya hay una redirección para este camino"
                },
                "posts": {
                    "create": "Error en la creación del articulo",
                    "update": "Error en la actualización del articulo",
                    "save": "Error en la salvado del articulo",
                    "delete": "Error en la eliminación del articulo"
                }
            },
            "frontend": {
                "user": {
                    "email_taken": "Esa dirección de correo electrónico ya está es uso.",
                    "password_mismatch": "Esa no es tu contraseña anterior.",
                    "delete_account": "Error al eliminar la cuenta.",
                    "updating_disabled": "La edición de cuenta está deshabilitada."
                },
                "auth": {
                    "registration_disabled": "El registro está desactivado."
                }
            }
        },
        "forms": {
            "contact": {
                "display_name": "Formulario de contacto"
            }
        },
        "labels": {
            "language": "Idioma",
            "actions": "Acciones",
            "general": "General",
            "no_results": "No hay resultados disponibles",
            "search": "Buscar",
            "validate": "Validar",
            "choose_file": "Seleccione el archivo",
            "no_file_chosen": "Ningún archivo seleccionado",
            "are_you_sure": "Estás seguro ?",
            "delete_image": "Eliminar imagen",
            "yes": "Sí",
            "no": "No",
            "add_new": "Añadir",
            "export": "Exportar",
            "more_info": "Más información",
            "author": "Autor",
            "author_id": "Autor ID",
            "last_access_at": "Último acceso a",
            "published_at": "Publicado en",
            "created_at": "Creado en",
            "updated_at": "Actualizado en",
            "deleted_at": "Eliminado en",
            "no_value": "Sin valor",
            "upload_image": "Cargar imagen",
            "anonymous": "Anónimo",
            "all_rights_reserved": "Todos los derechos reservados.",
            "with": "con",
            "by": "por",
            "datatables": {
                "no_results": "No hay resultados disponibles",
                "no_matched_results": "No hay resultados coincidentes disponibles",
                "show_per_page": "Mostrar",
                "entries_per_page": "entradas por página",
                "search": "Buscar",
                "infos": "Mostrando {offset_start} a {offset_end} de {total} entries"
            },
            "morphs": {
                "post": "Articulo, identidad {id}",
                "user": "Usuario, identidad{id}"
            },
            "auth": {
                "disabled": "Your account has been disabled."
            },
            "http": {
                "403": {
                    "title": "Acceso denegado",
                    "description": "Lo sentimos, pero no tienes permisos para acceder a esta página."
                },
                "404": {
                    "title": "Página no encontrada",
                    "description": "Lo sentimos, pero la página que intentabas ver no existe."
                },
                "500": {
                    "title": "Error del Servidor",
                    "description": "Lo sentimos, pero el servidor ha encontrado una situación que no sabe cómo manejar. Arreglaremos esto lo antes posible."
                }
            },
            "localization": {
                "en": "Inglés",
                "fr": "Francés",
                "es": "Español"
            },
            "placeholders": {
                "route": "Seleccione una ruta interna válida",
                "tags": "Seleccione o cree una etiqueta"
            },
            "cookieconsent": {
                "message": "Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestro sitio web.",
                "dismiss": "Estoy de acuerdo !"
            },
            "descriptions": {
                "allowed_image_types": "Tipos permitidos: png gif jpg jpeg."
            },
            "user": {
                "dashboard": "Controles",
                "remember": "Recuerda",
                "login": "Iniciar sesión",
                "logout": "Cerrar sesión",
                "password_forgot": "Contraseña olvidada ?",
                "send_password_link": "Enviar enlace para restablecer contraseña",
                "password_reset": "Restablecimiento de contraseña",
                "register": "Registro",
                "space": "Mi espacio",
                "settings": "Settings",
                "account": "Mi cuenta",
                "profile": "Mi perfil",
                "avatar": "Avatar",
                "online": "En línea",
                "edit_profile": "Editar mi perfil",
                "change_password": "Cambiar mi contraseña",
                "delete": "Borrar mi cuenta",
                "administration": "Administración",
                "member_since": "Miembro desde {date}",
                "profile_updated": "Perfil actualizado con éxito.",
                "password_updated": "Contraseña actualizada con éxito.",
                "super_admin": "Súper administrador",
                "account_delete": "<p>Esta acción eliminará por completo su cuenta de este sitio, así como todos los datos asociados.<\/p>",
                "account_deleted": "Cuenta eliminada con éxito",
                "titles": {
                    "space": "Mi espacio",
                    "account": "Mi cuenta"
                }
            },
            "alerts": {
                "login_as": "Actualmente as iniciado session como <strong>{name}<\/strong>, puedes cerrar sesión como <a href=\"{route}\" data-turbolinks=\"false\">{admin}<\/a>."
            },
            "backend": {
                "dashboard": {
                    "new_posts": "Artículos nuevos",
                    "pending_posts": "Artículos pendientes",
                    "published_posts": "Artículos Publicados",
                    "active_users": "Usuarios activos",
                    "form_submissions": "Solicitudes",
                    "last_posts": "Últimos artículos",
                    "last_published_posts": "Últimos artículos publicados",
                    "last_pending_posts": "Últimos artículos pendientes",
                    "last_new_posts": "Últimos artículos nuevos",
                    "all_posts": "Todos los artículos"
                },
                "new_menu": {
                    "post": "Nuevo articulo",
                    "form_setting": "Nueva configuración de formulario",
                    "user": "Nuevo usuario",
                    "role": "Nuevo rol",
                    "meta": "Nueva meta",
                    "redirection": "Nueva redirección"
                },
                "sidebar": {
                    "content": "Gestión de contenido",
                    "forms": "Gestión de formularios",
                    "access": "Gestión de Acceso",
                    "seo": "Ajustes SEO"
                },
                "titles": {
                    "dashboard": "Controles"
                },
                "users": {
                    "titles": {
                        "main": "Gestión de usuarios",
                        "index": "Lista de usuarios",
                        "create": "Creación de usuario",
                        "edit": "Modificación del usuario"
                    },
                    "actions": {
                        "destroy": "Eliminar usuarios seleccionados",
                        "enable": "Habilitar usuarios seleccionados",
                        "disable": "Desactivar usuarios seleccionados"
                    }
                },
                "roles": {
                    "titles": {
                        "main": "Gestión de roles",
                        "index": "Lista de roles",
                        "create": "Creación de roles",
                        "edit": "Modificación de roles"
                    }
                },
                "metas": {
                    "titles": {
                        "main": "Meta gestión",
                        "index": "Lista Meta",
                        "create": "Creación de Meta",
                        "edit": "Modificación de meta"
                    },
                    "actions": {
                        "destroy": "Eliminar metas seleccionadas"
                    }
                },
                "form_submissions": {
                    "titles": {
                        "main": "Gestión de solicitudes",
                        "index": "Lista de solicitudes",
                        "show": "Detalle de solicitud"
                    },
                    "actions": {
                        "destroy": "Elimiar solicitudes seleccionadas"
                    }
                },
                "form_settings": {
                    "titles": {
                        "main": "Configuración de formulario",
                        "index": "Lista de configuración de formulario",
                        "create": "Creación de configuración de formulario",
                        "edit": "Modificación de configuración de formulario"
                    },
                    "descriptions": {
                        "recipients": "Ejemplo: 'webmaster@example.com' o 'sales@example.com,support@example.com' . Para especificar múltiples destinatarios, separe cada dirección de correo electrónico con una coma.",
                        "message": "El mensaje para mostrar al usuario después del envío de este formulario. Dejar en blanco para ningún mensaje."
                    }
                },
                "redirections": {
                    "titles": {
                        "main": "Gestión de redirección",
                        "index": "Lista de redirección",
                        "create": "Creación de redirección",
                        "edit": "Modificación de redirección"
                    },
                    "actions": {
                        "destroy": "Eliminar las redirecciones seleccionadas",
                        "enable": "Habilitar redirecciones seleccionadas",
                        "disable": "Deshabilitar redirecciones seleccionadas"
                    },
                    "types": {
                        "permanent": "Redirección permanente (301)",
                        "temporary": "Redirección temporal (302)"
                    },
                    "import": {
                        "title": "Importación de archivo CSV",
                        "label": "Seleccionar archivo CSV para importar",
                        "description": "El archivo debe tener 2 columnas con \"source\" y \"target\" como encabezado, la redirección será permanente por defecto"
                    }
                },
                "posts": {
                    "statuses": {
                        "draft": "Borrador",
                        "pending": "Pendiente",
                        "published": "Publicado"
                    },
                    "titles": {
                        "main": "Gestión de artículos",
                        "index": "Lista de artículos",
                        "create": "Crear articulo",
                        "edit": "Editar articulo",
                        "publication": "Opciones de publicación"
                    },
                    "descriptions": {
                        "meta_title": "If leave empty, title will be that of article' title by default.",
                        "meta_description": "If leave empty, description will be that of article's summary by default."
                    },
                    "placeholders": {
                        "body": "Escribe tu contenido...",
                        "meta_title": "Título del articulo.",
                        "meta_description": "Resumen del articulo."
                    },
                    "actions": {
                        "destroy": "Eliminar artículos seleccionados",
                        "publish": "Publicar artículos seleccionados",
                        "pin": "Fijar artículos seleccionados",
                        "promote": "Promover artículos seleccionados"
                    }
                }
            },
            "frontend": {
                "titles": {
                    "home": "Inicio",
                    "about": "Acerca de",
                    "contact": "Contacto",
                    "blog": "Blog",
                    "message_sent": "Mensaje enviado",
                    "legal_mentions": "Menciones legales",
                    "administration": "Administración"
                },
                "submissions": {
                    "message_sent": "<p>Su mensaje ha sido enviado con éxito<\/p>"
                },
                "placeholders": {
                    "locale": "Selecciona tu idioma",
                    "timezone": "Selecciona tu zona horaria"
                },
                "blog": {
                    "published_at": "Publicado en {date}",
                    "published_at_with_owner_linkable": "Publicado en {date} por <a href=\"{link}\">{name}<\/a>",
                    "tags": "Etiquetas"
                }
            }
        },
        "logs": {
            "backend": {
                "users": {
                    "created": "Usuario ID {user} creado",
                    "updated": "Usuario ID {user} actualizado",
                    "deleted": "Usuario ID {user} borrado"
                },
                "form_submissions": {
                    "created": "ID de formulario de solicitud {form_submission} creado"
                }
            },
            "frontend": []
        },
        "mails": {
            "layout": {
                "hello": "Hola !",
                "regards": "Saludos",
                "trouble": "Si tiene problemas para hacer clic en botón {action}, copie y pegue la siguiente URL en su navegador web :",
                "all_rights_reserved": "Todos los derechos reservados."
            },
            "password_reset": {
                "subject": "Restablecimiento de contraseña",
                "intro": "Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.",
                "action": "Restablecer la contraseña",
                "outro": "Si no solicitó un restablecimiento de contraseña, no se requiere ninguna acción adicional."
            },
            "contact": {
                "subject": "Nuevo mensaje de contacto",
                "new_contact": "Tienes un nuevo mensaje de contacto. Detalle de presentación :"
            },
            "alert": {
                "subject": "[{app_name}] Error de excepción",
                "message": "Tienes un error de excepción del servidor inesperado, que es el mensaje : {message}.",
                "trace": "Todos los detalles de rastreo :"
            }
        },
        "pagination": {
            "previous": "&laquo; Anterior",
            "next": "Siguiente &raquo;"
        },
        "passwords": {
            "password": "Las contraseñas deben coincidir y contener al menos 6 caracteres",
            "reset": "¡Tu contraseña ha sido restablecida!",
            "sent": "¡Te hemos enviado por correo el enlace para restablecer tu contraseña!",
            "token": "El token de recuperación de contraseña es inválido.",
            "user": "No podemos encontrar ningún usuario con ese correo electrónico."
        },
        "permissions": {
            "categories": {
                "blog": "Blog",
                "form": "Formularios",
                "access": "Acceso",
                "seo": "SEO"
            },
            "access": {
                "backend": {
                    "display_name": "Acceso Backoffice",
                    "description": "Puede acceder a las páginas de administración."
                }
            },
            "view": {
                "form_settings": {
                    "display_name": "Ver configuración de formulario",
                    "description": "Puede ver la configuración del formulario."
                },
                "form_submissions": {
                    "display_name": "Ver formularios de solicitud",
                    "description": "Puede ver formularios de solicitud."
                },
                "users": {
                    "display_name": "Ver usuarios",
                    "description": "Puede ver a los usuarios."
                },
                "roles": {
                    "display_name": "Ver roles",
                    "description": "Puede ver roles."
                },
                "metas": {
                    "display_name": "Ver metas",
                    "description": "Puede ver metas"
                },
                "redirections": {
                    "display_name": "Ver redirecciones",
                    "description": "Puede ver las redirecciones."
                },
                "posts": {
                    "display_name": "Ver todos los artículos",
                    "description": "Puede ver todos los artículos."
                },
                "own": {
                    "posts": {
                        "display_name": "Ver artículos propios",
                        "description": "Puede ver artículos propios"
                    }
                }
            },
            "create": {
                "form_settings": {
                    "display_name": "Crear configuraciones de formulario",
                    "description": "Puede crear configuraciones de formulario."
                },
                "users": {
                    "display_name": "Crear usuarios",
                    "description": "Puede crear usuarios."
                },
                "roles": {
                    "display_name": "Crear roles",
                    "description": "Puede crear roles."
                },
                "metas": {
                    "display_name": "Crear metas",
                    "description": "Puede crear metas."
                },
                "redirections": {
                    "display_name": "Crear redirecciones",
                    "description": "Puede crear redirecciones."
                },
                "posts": {
                    "display_name": "Crear publicaciones",
                    "description": "Puede crear todas las publicaciones."
                }
            },
            "edit": {
                "form_settings": {
                    "display_name": "Editar configuración de formulario",
                    "description": "Puede editar la configuración del formulario."
                },
                "users": {
                    "display_name": "Editar usuarios",
                    "description": "Puede editar usuarios."
                },
                "roles": {
                    "display_name": "Editar roles",
                    "description": "Puede editar roles."
                },
                "metas": {
                    "display_name": "Editar metas",
                    "description": "Puede editar metas."
                },
                "redirections": {
                    "display_name": "Editar redirecciones",
                    "description": "Can edit redirections."
                },
                "posts": {
                    "display_name": "Editar todos los artículos",
                    "description": "Puede editar todos los artículos."
                },
                "own": {
                    "posts": {
                        "display_name": "Editar artículos propias",
                        "description": "Puede editar artículos propios."
                    }
                }
            },
            "delete": {
                "form_settings": {
                    "display_name": "Eliminar configuración de formulario",
                    "description": "Puede eliminar la configuración del formulario."
                },
                "form_submissions": {
                    "display_name": "Eliminar formularios de solicitud",
                    "description": "Puede eliminar formularios de solicitud."
                },
                "users": {
                    "display_name": "Eliminar usuarios",
                    "description": "Puede eliminar usuarios"
                },
                "roles": {
                    "display_name": "Eliminar roles",
                    "description": "Puede eliminar roles"
                },
                "metas": {
                    "display_name": "Eliminar metas",
                    "description": "Puede eliminar metas"
                },
                "redirections": {
                    "display_name": "Eliminar redirecciones",
                    "description": "Puede eliminar redirecciones."
                },
                "posts": {
                    "display_name": "Eliminar todos los artículos",
                    "description": "Puede eliminar todos los artículos."
                },
                "own": {
                    "posts": {
                        "display_name": "Eliminar artículos propios",
                        "description": "Puede eliminar artículos propios"
                    }
                }
            },
            "publish": {
                "posts": {
                    "display_name": "Publicar artículos",
                    "description": "Puede gestionar la publicación de artículos."
                }
            },
            "impersonate": {
                "display_name": "Suplantar usuario",
                "description": "Puede tomar posesión de otras identidades de usuario. Útil para las pruebas."
            }
        },
        "routes": {
            "home": "inicio",
            "about": "acerca",
            "contact": "contacto",
            "contact-sent": "envio-contacto",
            "legal-mentions": "menciones-legales",
            "redactors": "blog\/redactores\/{user}"
        },
        "validation": {
            "accepted": "{attribute} debe ser aceptado.",
            "active_url": "{attribute} no es una URL válida.",
            "after": "{attribute} debe ser una fecha posterior a {date}.",
            "after_or_equal": "{attribute} debe ser una fecha posterior o igual a {date}.",
            "alpha": "{attribute} sólo debe contener letras.",
            "alpha_dash": "{attribute} sólo debe contener letras, números y guiones.",
            "alpha_num": "{attribute} sólo debe contener letras y números.",
            "array": "{attribute} debe ser un conjunto.",
            "before": "{attribute} debe ser una fecha anterior a {date}.",
            "before_or_equal": "{attribute} debe ser una fecha anterior o igual a {date}.",
            "between": {
                "numeric": "{attribute} tiene que estar entre {min} - {max}.",
                "file": "{attribute} debe pesar entre {min} - {max} kilobytes.",
                "string": "{attribute} tiene que tener entre {min} - {max} caracteres.",
                "array": "{attribute} tiene que tener entre {min} - {max} ítems."
            },
            "boolean": "El campo {attribute} debe tener un valor verdadero o falso.",
            "confirmed": "La confirmación de {attribute} no coincide.",
            "date": "{attribute} no es una fecha válida.",
            "date_format": "{attribute} no corresponde al formato {format}.",
            "different": "{attribute} y {other} deben ser diferentes.",
            "digits": "{attribute} debe tener {digits} dígitos.",
            "digits_between": "{attribute} debe tener entre {min} y {max} dígitos.",
            "dimensions": "Las dimensiones de la imagen {attribute} no son válidas.",
            "distinct": "El campo {attribute} contiene un valor duplicado.",
            "email": "{attribute} no es un correo válido",
            "exists": "{attribute} es inválido.",
            "file": "El campo {attribute} debe ser un archivo.",
            "filled": "El campo {attribute} es obligatorio.",
            "image": "{attribute} debe ser una imagen.",
            "in": "{attribute} es inválido.",
            "in_array": "El campo {attribute} no existe en {other}.",
            "integer": "{attribute} debe ser un número entero.",
            "ip": "{attribute} debe ser una dirección IP válida.",
            "ipv4": "{attribute} debe ser un dirección IPv4 válida",
            "ipv6": "{attribute} debe ser un dirección IPv6 válida.",
            "json": "El campo {attribute} debe tener una cadena JSON válida.",
            "max": {
                "numeric": "{attribute} no debe ser mayor a {max}.",
                "file": "{attribute} no debe ser mayor que {max} kilobytes.",
                "string": "{attribute} no debe ser mayor que {max} caracteres.",
                "array": "{attribute} no debe tener más de {max} elementos."
            },
            "mimes": "{attribute} debe ser un archivo con formato: {values}.",
            "mimetypes": "{attribute} debe ser un archivo con formato: {values}.",
            "min": {
                "numeric": "El tamaño de {attribute} debe ser de al menos {min}.",
                "file": "El tamaño de {attribute} debe ser de al menos {min} kilobytes.",
                "string": "{attribute} debe contener al menos {min} caracteres.",
                "array": "{attribute} debe tener al menos {min} elementos."
            },
            "not_in": "{attribute} es inválido.",
            "not_regex": "El formato del campo {attribute} no es válido.",
            "numeric": "{attribute} debe ser numérico.",
            "present": "El campo {attribute} debe estar presente.",
            "regex": "El formato de {attribute} es inválido.",
            "required": "El campo {attribute} es obligatorio.",
            "required_if": "El campo {attribute} es obligatorio cuando {other} es {value}.",
            "required_unless": "El campo {attribute} es obligatorio a menos que {other} esté en {values}.",
            "required_with": "El campo {attribute} es obligatorio cuando {values} está presente.",
            "required_with_all": "El campo {attribute} es obligatorio cuando {values} está presente.",
            "required_without": "El campo {attribute} es obligatorio cuando {values} no está presente.",
            "required_without_all": "El campo {attribute} es obligatorio cuando ninguno de {values} estén presentes.",
            "same": "{attribute} y {other} deben coincidir.",
            "size": {
                "numeric": "El tamaño de {attribute} debe ser {size}.",
                "file": "El tamaño de {attribute} debe ser {size} kilobytes.",
                "string": "{attribute} debe contener {size} caracteres.",
                "array": "{attribute} debe contener {size} elementos."
            },
            "string": "El campo {attribute} debe ser una cadena de caracteres.",
            "timezone": "El {attribute} debe ser una zona válida.",
            "unique": "{attribute} ya ha sido registrado.",
            "uploaded": "Subir {attribute} ha fallado.",
            "url": "El formato {attribute} es inválido.",
            "custom": {
                "attribute-name": {
                    "rule-name": "mensaje personalizado"
                }
            },
            "attributes": {
                "name": "Nombre",
                "display_name": "Nombre para mostrar",
                "username": "Seudo",
                "email": "Email",
                "first_name": "Nombre",
                "last_name": "Apellidos",
                "password": "Contraseña",
                "password_confirmation": "Confirmar contraseña",
                "old_password": "Contraseña anterior",
                "new_password": "Nueva contraseña",
                "new_password_confirmation": "Confirmar nueva contraseña",
                "postal_code": "código postal",
                "city": "Ciudad",
                "country": "País",
                "address": "Dirección",
                "phone": "Teléfono",
                "mobile": "Móvil",
                "age": "Años",
                "sex": "Sexo",
                "gender": "Género",
                "day": "Día",
                "month": "Mes",
                "year": "Año",
                "hour": "Hora",
                "minute": "Minuto",
                "second": "Segundo",
                "title": "Título",
                "content": "Contenido",
                "description": "Descripción",
                "summary": "Resumen",
                "excerpt": "Extracto",
                "date": "Fecha",
                "time": "Hora",
                "available": "Disponible",
                "size": "Tamaño",
                "roles": "Roles",
                "permissions": "Permisos",
                "active": "Activo",
                "message": "Mensaje",
                "g-recaptcha-response": "Captcha",
                "locale": "Localización",
                "route": "Ruta",
                "url": "URL alias",
                "form_type": "Tipo de formulario",
                "form_data": "Datos de formulario",
                "recipients": "Destinatarios",
                "source_path": "Ruta original",
                "target_path": "Ruta de destino",
                "redirect_type": "Redirigir tipo",
                "timezone": "Zona horaria",
                "order": "Orden de visualización",
                "image": "Imagen",
                "status": "Estado",
                "pinned": "Fijado",
                "promoted": "Promovido",
                "body": "Cuerpo",
                "tags": "Etiquetas",
                "published_at": "Publicar en",
                "unpublished_at": "Anular publicación en",
                "metable_type": "Entidad"
            }
        }
    },
    "fr": {
        "alerts": {
            "backend": {
                "users": {
                    "created": "Utilisateur créé",
                    "updated": "Utilisateur mis à jour",
                    "deleted": "Utilisateur supprimé",
                    "bulk_destroyed": "Utilisateurs sélectionnés supprimés",
                    "bulk_enabled": "Utilisateurs sélectionnés activés",
                    "bulk_disabled": "Utilisateurs sélectionnés désactivés"
                },
                "roles": {
                    "created": "Rôle créé",
                    "updated": "Rôle mis à jour",
                    "deleted": "Rôle supprimé"
                },
                "metas": {
                    "created": "Meta créée",
                    "updated": "Meta mise à jour",
                    "deleted": "Meta supprimée",
                    "bulk_destroyed": "Metas sélectionnées supprimées"
                },
                "form_submissions": {
                    "deleted": "Soumission supprimée",
                    "bulk_destroyed": "Soumissions sélectionnées supprimées"
                },
                "form_settings": {
                    "created": "Paramétrage de formulaire créé",
                    "updated": "Paramétrage de formulaire mis à jour",
                    "deleted": "Paramétrage de formulaire supprimé"
                },
                "redirections": {
                    "created": "Redirection créée",
                    "updated": "Redirection mise à jour",
                    "deleted": "Redirection supprimée",
                    "bulk_destroyed": "Redirections sélectionnées supprimées",
                    "bulk_enabled": "Redirections sélectionnées activées",
                    "bulk_disabled": "Redirections sélectionnées désactivées",
                    "file_imported": "Fichier importé avec succès"
                },
                "posts": {
                    "created": "Article créé",
                    "updated": "Article mis à jour",
                    "deleted": "Article supprimé",
                    "bulk_destroyed": "Articles sélectionnés supprimés",
                    "bulk_published": "Articles sélectionnés publiés",
                    "bulk_pending": "Articles sélectionnés en attente de modération",
                    "bulk_pinned": "Articles sélectionnés épinglé",
                    "bulk_promoted": "Articles sélectionnés mis en avant"
                },
                "actions": {
                    "invalid": "Action invalide"
                }
            },
            "frontend": []
        },
        "auth": {
            "failed": "Ces identifiants ne correspondent pas à nos enregistrements",
            "throttle": "Trop de tentatives de connexion. Veuillez essayer de nouveau dans {seconds} secondes.",
            "socialite": {
                "unacceptable": "{provider} n'est pas accepté."
            }
        },
        "buttons": {
            "cancel": "Annuler",
            "save": "Sauvegarder",
            "close": "Fermer",
            "create": "Créer",
            "delete": "Supprimer",
            "confirm": "Valider",
            "show": "Voir",
            "edit": "Editer",
            "update": "Mettre à jour",
            "view": "Voir",
            "preview": "Prévisualiser",
            "back": "Retour",
            "send": "Envoyer",
            "login-as": "Se loguer en tant que {name}",
            "apply": "Appliquer",
            "users": {
                "create": "Créer un utilisateur"
            },
            "roles": {
                "create": "Créer un rôle"
            },
            "metas": {
                "create": "Créer une meta"
            },
            "form_settings": {
                "create": "Créer un paramètre"
            },
            "redirections": {
                "create": "Créer une redirection",
                "import": "Importer le CSV"
            },
            "posts": {
                "create": "Créer un article",
                "save_and_publish": "Enregistrer et publier",
                "save_as_draft": "Enregistrer en tant que brouillon"
            }
        },
        "exceptions": {
            "general": "Erreur serveur",
            "unauthorized": "Action non autorisée",
            "backend": {
                "users": {
                    "create": "Erreur lors de la création de l'utilisateur",
                    "update": "Erreur lors de la mise à jour de l'utilisateur",
                    "delete": "Erreur lors de la suppression de l'utilisateur",
                    "first_user_cannot_be_edited": "Vous ne pouvez pas éditer l'utilisateur super admin",
                    "first_user_cannot_be_disabled": "L'utilisateur super admin ne peut pas être désactivé",
                    "first_user_cannot_be_destroyed": "L'utilisateur super admin ne peut pas être supprimé",
                    "first_user_cannot_be_impersonated": "L'utilisateur super admin ne peut pas être usurpé",
                    "cannot_set_superior_roles": "Vous ne pouvez pas attribuer de rôle supérieur au vôtre"
                },
                "roles": {
                    "create": "Erreur lors de la création du rôle",
                    "update": "Erreur lors de la mise à jour du rôle",
                    "delete": "Erreur lors de la suppression du rôle"
                },
                "metas": {
                    "create": "Erreur lors de la création de la meta",
                    "update": "Erreur lors de la mise à jour de la meta",
                    "delete": "Erreur lors de la suppression de la meta",
                    "already_exist": "Il existe déjà une meta pour cette route"
                },
                "form_submissions": {
                    "create": "Erreur lors de la création de la soumission",
                    "delete": "Erreur lors de la suppression de la soumission"
                },
                "form_settings": {
                    "create": "Erreur lors de la création du paramètre de formulaire",
                    "update": "Erreur lors de la mise à jour du paramètre de formulaire",
                    "delete": "Erreur lors de la suppression du paramètre de formulaire",
                    "already_exist": "Il existe déjà un paramétrage pour ce formulaire"
                },
                "redirections": {
                    "create": "Erreur lors de la création de la redirection",
                    "update": "Erreur lors de la mise à jour de la redirection",
                    "delete": "Erreur lors de la suppression de la redirection",
                    "already_exist": "Il existe déjà une redirection pour ce chemin"
                },
                "posts": {
                    "create": "Erreur lors de la création de l'article",
                    "update": "Erreur lors de la mise à jour de l'article",
                    "save": "Erreur lors de l'enregistrement de l'article",
                    "delete": "Erreur lors de la suppression de l'article"
                }
            },
            "frontend": {
                "user": {
                    "email_taken": "Cet email est déjà utilisé par un compte existant.",
                    "password_mismatch": "L'ancien mot de passe est incorrect.",
                    "delete_account": "Erreur lors de la suppression de votre compte.",
                    "updating_disabled": "La modification de compte est désactivée."
                },
                "auth": {
                    "registration_disabled": "L'enregistrement d'utilisateurs est désactivé."
                }
            }
        },
        "forms": {
            "contact": {
                "display_name": "Formulaire de contact"
            }
        },
        "labels": {
            "language": "Langue",
            "actions": "Actions",
            "general": "Général",
            "no_results": "Aucun résultat trouvé",
            "search": "Rechercher",
            "validate": "Valider",
            "choose_file": "Sélectionner un fichier",
            "no_file_chosen": "Aucun fichier sélectionné",
            "are_you_sure": "Etes-vous sûr ?",
            "delete_image": "Supprimer l'image",
            "yes": "Oui",
            "no": "Non",
            "add_new": "Ajouter",
            "export": "Exporter",
            "more_info": "Plus d'info",
            "last_access_at": "Dernier accès le",
            "author": "Auteur",
            "author_id": "ID Auteur",
            "published_at": "Publié le",
            "created_at": "Créé le",
            "updated_at": "Modifié le",
            "deleted_at": "Supprimé le",
            "no_value": "Aucune valeur",
            "upload_image": "Transférer une image",
            "anonymous": "Anonyme",
            "all_rights_reserved": "Tous droits réservés.",
            "with": "avec",
            "by": "par",
            "datatables": {
                "no_results": "Aucun résultat trouvé",
                "no_matched_results": "Aucun résultat correspondant à votre recherche",
                "show_per_page": "Afficher",
                "entries_per_page": "éléments par page",
                "search": "Rechercher",
                "infos": "Affichage de l'élément {offset_start} à {offset_end} sur {total} éléments"
            },
            "morphs": {
                "post": "Article, identifiant {id}",
                "user": "Utilisateur, identifiant {id}"
            },
            "auth": {
                "disabled": "Votre compte a été désactivé."
            },
            "http": {
                "403": {
                    "title": "Accès non autorisé",
                    "description": "Désolé, mais vous n'avez pas les permissions pour accéder à cette page."
                },
                "404": {
                    "title": "Page introuvable",
                    "description": "Désolé, mais la page à laquelle vous tentez d'accéder n'existe pas."
                },
                "500": {
                    "title": "Erreur serveur",
                    "description": "Désolé, mais le serveur a rencontré une erreur non prévue. Nous la fixerons dès que possible."
                }
            },
            "localization": {
                "en": "Anglais",
                "fr": "Français"
            },
            "placeholders": {
                "route": "Sélectionner une route interne valide",
                "tags": "Sélectionner ou créer une étiquette"
            },
            "cookieconsent": {
                "message": "En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies afin de réaliser des statistiques de visites.",
                "dismiss": "J'ai compris !"
            },
            "descriptions": {
                "allowed_image_types": "Extensions autorisés: png gif jpg jpeg."
            },
            "user": {
                "dashboard": "Tableau de bord",
                "remember": "Se souvenir",
                "login": "Connexion",
                "logout": "Déconnexion",
                "password_forgot": "Mot de passe oublié ?",
                "send_password_link": "Envoyer le mot de passe de réinitialisation",
                "password_reset": "Réinitialisation du mot de passe",
                "register": "S'inscrire",
                "space": "Mon espace",
                "settings": "Paramètres",
                "account": "Mon compte",
                "profile": "Mon profil",
                "avatar": "Avatar",
                "online": "En ligne",
                "edit_profile": "Mettre à jour mon profil",
                "change_password": "Changer mon mot de passe",
                "delete": "Supprimer mon compte",
                "administration": "Administration",
                "member_since": "Membre depuis le {date}",
                "profile_updated": "Profil modifié avec succès.",
                "password_updated": "Mot de passe modifié avec succès.",
                "super_admin": "Super admin",
                "account_delete": "<p>Cette action supprimera définitivement votre compte de ce site ainsi que toutes vos données associées.<\/p>",
                "account_deleted": "Compte supprimé avec succès",
                "titles": {
                    "space": "Mon espace",
                    "account": "Mon compte"
                }
            },
            "alerts": {
                "login_as": "Vous êtes actuellement connecté en tant que <strong>{name}<\/strong>, vous pouvez à tout moment vous reconnecter en tant que <a href=\"{route}\" data-turbolinks=\"false\">{admin}<\/a>."
            },
            "backend": {
                "dashboard": {
                    "new_posts": "Nouveaux articles",
                    "pending_posts": "Articles en attente de publication",
                    "published_posts": "Articles publiés",
                    "active_users": "Utilisateurs actifs",
                    "form_submissions": "Soumissions",
                    "last_posts": "Dernier articles",
                    "last_published_posts": "Dernières publications",
                    "last_pending_posts": "Derniers articles en attente de publication",
                    "last_new_posts": "Derniers nouveaux articles",
                    "all_posts": "Voir tous les articles"
                },
                "new_menu": {
                    "post": "Nouvel article",
                    "form_setting": "Nouveau paramétrage de formulaire",
                    "user": "Nouvel utilisateur",
                    "role": "Nouveau rôle",
                    "meta": "Nouvelle meta",
                    "redirection": "Nouvelle redirection"
                },
                "sidebar": {
                    "content": "Gestion de contenu",
                    "forms": "Gestion des formulaires",
                    "access": "Gestion des accès",
                    "seo": "Paramétrages SEO"
                },
                "titles": {
                    "dashboard": "Tableau de bord"
                },
                "users": {
                    "titles": {
                        "main": "Utilisateurs",
                        "index": "Liste des utilisateurs",
                        "create": "Créer un utilisateur",
                        "edit": "Editer un utilisateur"
                    },
                    "actions": {
                        "destroy": "Supprimer les utilisateurs sélectionnés",
                        "enable": "Activer les utilisateurs sélectionnés",
                        "disable": "Désactiver les utilisateurs sélectionnés"
                    }
                },
                "roles": {
                    "titles": {
                        "main": "Rôles",
                        "index": "Liste des rôles",
                        "create": "Créer un rôle",
                        "edit": "Editer un rôle"
                    }
                },
                "metas": {
                    "titles": {
                        "main": "Metas",
                        "index": "Liste des metas",
                        "create": "Créer une meta",
                        "edit": "Editer une meta"
                    },
                    "actions": {
                        "destroy": "Supprimer les metas sélectionnés"
                    }
                },
                "form_submissions": {
                    "titles": {
                        "main": "Soumissions",
                        "index": "Liste des soumissions",
                        "show": "Détail de la soumission"
                    },
                    "actions": {
                        "destroy": "Supprimer les soumissions sélectionnées"
                    }
                },
                "form_settings": {
                    "titles": {
                        "main": "Formulaires",
                        "index": "Liste des paramètres de formulaire",
                        "create": "Création d'un paramètre de formulaire",
                        "edit": "Edition d'un paramètre de formulaire"
                    },
                    "descriptions": {
                        "recipients": "Exemple: 'webmaster@example.com' or 'sales@example.com,support@example.com' . Pour déclarer des destinataires multiples, séparer chaque adresse par une virgule.",
                        "message": "Le message à afficher après la soumission de ce formulaire. Laissez vide pour n'afficher aucun message."
                    }
                },
                "redirections": {
                    "titles": {
                        "main": "Redirections",
                        "index": "Liste des redirections",
                        "create": "Création d'une redirection",
                        "edit": "Modification d'une redirection"
                    },
                    "actions": {
                        "destroy": "Supprimer les redirections sélectionnées",
                        "enable": "Activer les redirections sélectionnées",
                        "disable": "Désactiver les redirections sélectionnées"
                    },
                    "types": {
                        "permanent": "Redirection permanente (301)",
                        "temporary": "Redirection temporaire (302)"
                    },
                    "import": {
                        "title": "Import de fichier CSV",
                        "label": "Sélectionner un fichier CSV à importer",
                        "description": "Le fichier doit avoir 2 colonnes avec en-têtes de colonne \"source\" et \"target\", la redirection sera du type permanent par défaut"
                    }
                },
                "posts": {
                    "statuses": {
                        "draft": "Brouillon",
                        "pending": "En attente",
                        "published": "Publié"
                    },
                    "titles": {
                        "main": "Articles",
                        "index": "Liste des articles",
                        "create": "Créer un article",
                        "edit": "Editer un article",
                        "publication": "Options de publication"
                    },
                    "actions": {
                        "destroy": "Supprimer les articles sélectionnés",
                        "publish": "Publier les articles sélectionnés",
                        "pin": "Epingler les articles sélectionnés",
                        "promote": "Mettre en avant les articles sélectionnés"
                    },
                    "descriptions": {
                        "meta_title": "Si vide, le titre par défaut sera celui de l'article.",
                        "meta_description": "Si vide, la description par défaut sera le résumé de l'article."
                    },
                    "placeholders": {
                        "body": "Saisissez votre contenu...",
                        "meta_title": "Titre de l'article.",
                        "meta_description": "Résumé de l'article."
                    }
                }
            },
            "frontend": {
                "titles": {
                    "home": "Accueil",
                    "about": "Qui sommes-nous ?",
                    "contact": "Contact",
                    "blog": "Blog",
                    "message_sent": "Message envoyé",
                    "legal_mentions": "Mention légales",
                    "administration": "Administration"
                },
                "submissions": {
                    "message_sent": "<p>Votre demande de contact a bien été envoyée<\/p>"
                },
                "placeholders": {
                    "locale": "Sélectionnez votre langue",
                    "timezone": "Sélectionnez votre fuseau horaire"
                },
                "blog": {
                    "published_at": "Publié le {date}",
                    "published_at_with_owner_linkable": "Publié le {date} par <a href=\"{link}\">{name}<\/a>",
                    "tags": "Tags"
                }
            }
        },
        "logs": {
            "backend": {
                "users": {
                    "created": "Utilisateur ID {user} créé",
                    "updated": "Utilisateur ID {user} mis à jour",
                    "deleted": "Utilisateur ID {user} supprimé"
                },
                "form_submissions": {
                    "created": "Soumission de formulaire ID {form_submission} créée"
                }
            },
            "frontend": []
        },
        "mails": {
            "layout": {
                "hello": "Bonjour !",
                "regards": "Cordialement",
                "trouble": "Si vous rencontrer un problème en cliquant sur le bouton {action}, copier et coller l'URL suivante dans votre navigateur :",
                "all_rights_reserved": "Tous droits réservés."
            },
            "password_reset": {
                "subject": "Réinitialisation de mon mot de passe",
                "intro": "Vous recevez cet email car vous avez effectué une demande de réinitialisation de mot de passe.",
                "action": "Réinitialiser le mot de passe",
                "outro": "Si vous n'avez pas fait cette demande de réinitialisation, aucune action n'est requise."
            },
            "contact": {
                "subject": "Nouveau message de contact",
                "new_contact": "Vous avez reçu un nouveau message de contact. Détail de la soumission :"
            },
            "alert": {
                "subject": "[{app_name}] Exception error",
                "message": "Une exception serveur non prévue a été levée dont le message est : {message}.",
                "trace": "Trace complète :"
            }
        },
        "pagination": {
            "previous": "&laquo; Précédent",
            "next": "Suivant &raquo;"
        },
        "passwords": {
            "password": "Les mots de passe doivent contenir au moins six caractères et doivent être identiques.",
            "reset": "Votre mot de passe a été réinitialisé !",
            "sent": "Nous vous avons envoyé par courriel le lien de réinitialisation du mot de passe !",
            "token": "Ce jeton de réinitialisation du mot de passe n'est pas valide.",
            "user": "Aucun utilisateur n'a été trouvé avec cette adresse e-mail."
        },
        "permissions": {
            "categories": {
                "blog": "Blog",
                "form": "Formulaires",
                "access": "Accès",
                "seo": "SEO"
            },
            "access": {
                "backend": {
                    "display_name": "Accès au backoffice",
                    "description": "Permet l'accès aux pages du backoffice."
                }
            },
            "view": {
                "form_settings": {
                    "display_name": "Voir les paramètres de formulaires",
                    "description": "Peut voir des paramètres de formulaires."
                },
                "form_submissions": {
                    "display_name": "Voir les soumissions de formulaire",
                    "description": "Peut voir des soumissions de formulaire."
                },
                "users": {
                    "display_name": "Voir les utilisateurs",
                    "description": "Peut voir des utilisateurs."
                },
                "roles": {
                    "display_name": "Voir les rôles",
                    "description": "Peut voir des rôles."
                },
                "metas": {
                    "display_name": "Voir les metas",
                    "description": "Peut voir des metas."
                },
                "redirections": {
                    "display_name": "Voir les redirections",
                    "description": "Peut voir des redirections."
                },
                "posts": {
                    "display_name": "Voir tous les articles",
                    "description": "Peut voir l'ensemble des articles."
                },
                "own": {
                    "posts": {
                        "display_name": "Voir ses propres articles",
                        "description": "Peut voir ses propres articles."
                    }
                }
            },
            "create": {
                "form_settings": {
                    "display_name": "Créer les paramètres de formulaires",
                    "description": "Peut créer des paramètres de formulaires."
                },
                "users": {
                    "display_name": "Créer les utilisateurs",
                    "description": "Peut créer des utilisateurs."
                },
                "roles": {
                    "display_name": "Créer les rôles",
                    "description": "Peut créer des rôles."
                },
                "metas": {
                    "display_name": "Créer les metas",
                    "description": "Peut créer des metas."
                },
                "redirections": {
                    "display_name": "Créer les redirections",
                    "description": "Peut créer des redirections."
                },
                "posts": {
                    "display_name": "Créer les articles",
                    "description": "Peut créer des articles."
                }
            },
            "edit": {
                "form_settings": {
                    "display_name": "Modifier les paramètres de formulaires",
                    "description": "Peut modifier des paramètres de formulaires."
                },
                "users": {
                    "display_name": "Modifier les utilisateurs",
                    "description": "Peut modifier des utilisateurs."
                },
                "roles": {
                    "display_name": "Modifier les rôles",
                    "description": "Peut modifier des rôles."
                },
                "metas": {
                    "display_name": "Modifier les metas",
                    "description": "Peut modifier des metas."
                },
                "redirections": {
                    "display_name": "Modifier les redirections",
                    "description": "Peut modifier des redirections."
                },
                "posts": {
                    "display_name": "Modifier tous les articles",
                    "description": "Peut modifier l'ensemble des articles."
                },
                "own": {
                    "posts": {
                        "display_name": "Modifier ses propres articles",
                        "description": "Peut modifier ses propres articles."
                    }
                }
            },
            "delete": {
                "form_settings": {
                    "display_name": "Supprimer les paramètres de formulaires",
                    "description": "Peut supprimer des paramètres de formulaires."
                },
                "form_submissions": {
                    "display_name": "Supprimer les soumissions de formulaire",
                    "description": "Peut supprimer des soumissions de formulaire."
                },
                "users": {
                    "display_name": "Supprimer les utilisateurs",
                    "description": "Peut supprimer des utilisateurs."
                },
                "roles": {
                    "display_name": "Supprimer les rôles",
                    "description": "Peut supprimer des rôles."
                },
                "metas": {
                    "display_name": "Supprimer les metas",
                    "description": "Peut supprimer des metas."
                },
                "redirections": {
                    "display_name": "Supprimer les redirections",
                    "description": "Peut supprimer des redirections."
                },
                "posts": {
                    "display_name": "Supprimer tous les articles",
                    "description": "Peut supprimer l'ensemble des articles."
                },
                "own": {
                    "posts": {
                        "display_name": "Supprimer ses propres articles",
                        "description": "Peut supprimer ses propres articles."
                    }
                }
            },
            "publish": {
                "posts": {
                    "display_name": "Publier les articles",
                    "description": "Possibilité de gérer la publication des articles."
                }
            },
            "impersonate": {
                "display_name": "Usurpation d'utilisateur",
                "description": "Permet de prendre l'identité d'un autre utilisateur. Utile pour les tests."
            }
        },
        "routes": {
            "home": "accueil",
            "about": "qui-sommes-nous",
            "contact": "demande-de-contact",
            "contact-sent": "message-envoyee",
            "legal-mentions": "mentions-legales",
            "redactors": "blog\/redacteurs\/{user}"
        },
        "validation": {
            "accepted": "Le champ {attribute} doit être accepté.",
            "active_url": "Le champ {attribute} n'est pas une URL valide.",
            "after": "Le champ {attribute} doit être une date postérieure au {date}.",
            "after_or_equal": "Le champ {attribute} doit être une date postérieure ou égal au {date}.",
            "alpha": "Le champ {attribute} doit seulement contenir des lettres.",
            "alpha_dash": "Le champ {attribute} doit seulement contenir des lettres, des chiffres et des tirets.",
            "alpha_num": "Le champ {attribute} doit seulement contenir des chiffres et des lettres.",
            "array": "Le champ {attribute} doit être un tableau.",
            "before": "Le champ {attribute} doit être une date antérieure au {date}.",
            "before_or_equal": "Le champ {attribute} doit être une date antérieure ou égal au {date}.",
            "between": {
                "numeric": "La valeur de {attribute} doit être comprise entre {min} et {max}.",
                "file": "La taille du fichier de {attribute} doit être comprise entre {min} et {max} kilo-octets.",
                "string": "Le texte {attribute} doit contenir entre {min} et {max} caractères.",
                "array": "Le tableau {attribute} doit contenir entre {min} et {max} éléments."
            },
            "boolean": "Le champ {attribute} doit être vrai ou faux.",
            "confirmed": "Le champ de confirmation {attribute} ne correspond pas.",
            "date": "Le champ {attribute} n'est pas une date valide.",
            "date_format": "Le champ {attribute} ne correspond pas au format {format}.",
            "different": "Les champs {attribute} et {other} doivent être différents.",
            "digits": "Le champ {attribute} doit contenir {digits} chiffres.",
            "digits_between": "Le champ {attribute} doit contenir entre {min} et {max} chiffres.",
            "dimensions": "La taille de l'image {attribute} n'est pas conforme.",
            "distinct": "Le champ {attribute} a une valeur dupliquée.",
            "email": "Le champ {attribute} doit être une adresse e-mail valide.",
            "exists": "Le champ {attribute} sélectionné est invalide.",
            "file": "Le champ {attribute} doit être un fichier.",
            "filled": "Le champ {attribute} doit avoir une valeur.",
            "image": "Le champ {attribute} doit être une image.",
            "in": "Le champ {attribute} est invalide.",
            "in_array": "Le champ {attribute} n'existe pas dans {other}.",
            "integer": "Le champ {attribute} doit être un entier.",
            "ip": "Le champ {attribute} doit être une adresse IP valide.",
            "ipv4": "Le champ {attribute} doit être une adresse IPv4 valide.",
            "ipv6": "Le champ {attribute} doit être une adresse IPv6 valide.",
            "json": "Le champ {attribute} doit être un document JSON valide.",
            "max": {
                "numeric": "La valeur de {attribute} ne peut être supérieure à {max}.",
                "file": "La taille du fichier de {attribute} ne peut pas dépasser {max} kilo-octets.",
                "string": "Le texte de {attribute} ne peut contenir plus de {max} caractères.",
                "array": "Le tableau {attribute} ne peut contenir plus de {max} éléments."
            },
            "mimes": "Le champ {attribute} doit être un fichier de type : {values}.",
            "mimetypes": "Le champ {attribute} doit être un fichier de type : {values}.",
            "min": {
                "numeric": "La valeur de {attribute} doit être supérieure ou égale à {min}.",
                "file": "La taille du fichier de {attribute} doit être supérieure à {min} kilo-octets.",
                "string": "Le texte {attribute} doit contenir au moins {min} caractères.",
                "array": "Le tableau {attribute} doit contenir au moins {min} éléments."
            },
            "not_in": "Le champ {attribute} sélectionné n'est pas valide.",
            "not_regex": "Le format du champ {attribute} n'est pas valide.",
            "numeric": "Le champ {attribute} doit contenir un nombre.",
            "present": "Le champ {attribute} doit être présent.",
            "regex": "Le format du champ {attribute} est invalide.",
            "required": "Le champ {attribute} est obligatoire.",
            "required_if": "Le champ {attribute} est obligatoire quand la valeur de {other} est {value}.",
            "required_unless": "Le champ {attribute} est obligatoire sauf si {other} est {values}.",
            "required_with": "Le champ {attribute} est obligatoire quand {values} est présent.",
            "required_with_all": "Le champ {attribute} est obligatoire quand {values} est présent.",
            "required_without": "Le champ {attribute} est obligatoire quand {values} n'est pas présent.",
            "required_without_all": "Le champ {attribute} est requis quand aucun de {values} n'est présent.",
            "same": "Les champs {attribute} et {other} doivent être identiques.",
            "size": {
                "numeric": "La valeur de {attribute} doit être {size}.",
                "file": "La taille du fichier de {attribute} doit être de {size} kilo-octets.",
                "string": "Le texte de {attribute} doit contenir {size} caractères.",
                "array": "Le tableau {attribute} doit contenir {size} éléments."
            },
            "string": "Le champ {attribute} doit être une chaîne de caractères.",
            "timezone": "Le champ {attribute} doit être un fuseau horaire valide.",
            "unique": "La valeur du champ {attribute} est déjà utilisée.",
            "uploaded": "Le fichier du champ {attribute} n'a pu être téléchargé.",
            "url": "Le format de l'URL de {attribute} n'est pas valide.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "Nom",
                "display_name": "Nom affiché",
                "username": "Pseudo",
                "email": "Adresse e-mail",
                "first_name": "Prénom",
                "last_name": "Nom",
                "password": "Mot de passe",
                "password_confirmation": "Confirmation du mot de passe",
                "old_password": "Ancien mot de passe",
                "new_password": "Nouveau mot de passe",
                "new_password_confirmation": "Confirmation du nouveau mot de passe",
                "postal_code": "Code postal",
                "city": "Ville",
                "country": "Pays",
                "address": "Adresse",
                "phone": "Téléphone",
                "mobile": "Portable",
                "age": "Age",
                "sex": "Sexe",
                "gender": "Genre",
                "day": "Jour",
                "month": "Mois",
                "year": "Année",
                "hour": "Heure",
                "minute": "Minute",
                "second": "Seconde",
                "title": "Titre",
                "content": "Contenu",
                "description": "Description",
                "summary": "Résumé",
                "excerpt": "Extrait",
                "date": "Date",
                "time": "Heure",
                "available": "Disponible",
                "size": "Taille",
                "roles": "Rôles",
                "permissions": "Permissions",
                "active": "Actif",
                "message": "Message",
                "g-recaptcha-response": "Captcha",
                "locale": "Localisation",
                "route": "Route",
                "url": "Alias URL",
                "form_type": "Type de formulaire",
                "form_data": "Données du formulaire",
                "recipients": "Destinataires",
                "source_path": "Chemin origine",
                "target_path": "Chemin cible",
                "redirect_type": "Type de redirection",
                "timezone": "Fuseau horaire",
                "order": "Ordre d'affichage",
                "image": "Image",
                "status": "Statut",
                "pinned": "Epinglé",
                "promoted": "Mis en avant",
                "body": "Corps",
                "tags": "Etiquettes",
                "published_at": "Publier le",
                "unpublished_at": "Dépublier le",
                "metable_type": "Entité"
            }
        }
    },
    "ru": {
        "alerts": {
            "backend": {
                "users": {
                    "created": "Пользователь создан",
                    "updated": "Пользователь обновлён",
                    "deleted": "Пользователь удалён",
                    "bulk_destroyed": "Выбранные пользователи удалены",
                    "bulk_enabled": "Выбранные пользователи активированы",
                    "bulk_disabled": "Выбранные пользователи заблокированы"
                },
                "roles": {
                    "created": "Роль создана",
                    "updated": "Роль обновлена",
                    "deleted": "Роль удалена"
                },
                "metas": {
                    "created": "Метаданные созданы",
                    "updated": "Метаданные обновлены",
                    "deleted": "Метаданные удалены",
                    "bulk_destroyed": "Выбранные метаданные удалены"
                },
                "form_submissions": {
                    "deleted": "Представление удалёно",
                    "bulk_destroyed": "Выбранные представления удалены"
                },
                "form_settings": {
                    "created": "Настройка формы создана",
                    "updated": "Настройка формы обновлена",
                    "deleted": "Настройка формы удалена"
                },
                "redirections": {
                    "created": "Перенаправление создано",
                    "updated": "Перенаправление обновлено",
                    "deleted": "Перенаправление удалено",
                    "bulk_destroyed": "Выделенные перенаправления удалены",
                    "bulk_enabled": "Выделенные перенаправления включены",
                    "bulk_disabled": "Выделенные перенаправления отключены",
                    "file_imported": "Файл успешно импортирован"
                },
                "posts": {
                    "created": "Статья создана",
                    "updated": "Статья обновлена",
                    "deleted": "Статья удалена",
                    "bulk_destroyed": "Выбранные статьи удалены",
                    "bulk_published": "Выбранные статьи опубликованы",
                    "bulk_pending": "Выбранные статьи ожидают проверки",
                    "bulk_pinned": "Выбранные статьи закреплены",
                    "bulk_promoted": "Выбранные статьи выделены"
                },
                "actions": {
                    "invalid": "Неверное действие"
                }
            },
            "frontend": []
        },
        "auth": {
            "failed": "Эти учетные данные не соответствуют нашим записям.",
            "throttle": "Слишком много попыток входа. Пожалуйста, попробуйте снова через {seconds} секунд.",
            "socialite": {
                "unacceptable": "{provider} не является допустимым типом входа."
            }
        },
        "buttons": {
            "cancel": "Отмена",
            "save": "Сохранить",
            "close": "Закрыть",
            "create": "Создать",
            "delete": "Удалить",
            "confirm": "Подтвердить",
            "show": "Показать",
            "edit": "Изменить",
            "update": "Обновить",
            "view": "Смотреть",
            "preview": "Предпросмотр",
            "back": "Назад",
            "send": "Отправить",
            "login-as": "Войти как {name}",
            "apply": "Применить",
            "users": {
                "create": "Создать пользователя"
            },
            "roles": {
                "create": "Создать роль"
            },
            "metas": {
                "create": "Создать метаданные"
            },
            "form_settings": {
                "create": "Создать форму"
            },
            "redirections": {
                "create": "Создать перенаправление",
                "import": "Загрузить CSV"
            },
            "posts": {
                "create": "Создать статью",
                "save_and_publish": "Сохранить и опубликовать",
                "save_as_draft": "Сохранить как черновик"
            }
        },
        "exceptions": {
            "general": "Серверная ошибка",
            "unauthorized": "Недопустимое действие",
            "backend": {
                "users": {
                    "create": "Ошибка создания пользователя",
                    "update": "Ошибка обновления пользователя",
                    "delete": "Ошибка удаления пользователя",
                    "first_user_cannot_be_edited": "Вы не можете редактировать супер-администратора",
                    "first_user_cannot_be_disabled": "Супер-администратор не может быть отключён",
                    "first_user_cannot_be_destroyed": "Супер-администратор не может быть удалён",
                    "first_user_cannot_be_impersonated": "Нельзя войти под видом супер-администратора",
                    "cannot_set_superior_roles": "Вы не можете назначать роли, превосходящие ваши"
                },
                "roles": {
                    "create": "Ошибка создания роли",
                    "update": "Ошибка обновления роли",
                    "delete": "Ошибка удаления роли"
                },
                "metas": {
                    "create": "Ошибка создания метаданных",
                    "update": "Ошибка обновления метаданных",
                    "delete": "Ошибка удаления метаданных",
                    "already_exist": "Для этих языковых настроек уже есть метаданные"
                },
                "form_submissions": {
                    "create": "Ошибка создания представления",
                    "delete": "Ошибка удаления представления"
                },
                "form_settings": {
                    "create": "Ошибка создания настройки формы",
                    "update": "Ошибка обновления настройки формы",
                    "delete": "Ошибка удаления настройки формы",
                    "already_exist": "Уже существует настройка, связанная с этой формой"
                },
                "redirections": {
                    "create": "Ошибка создания перенаправления",
                    "update": "Ошибка обновления перенаправления",
                    "delete": "Ошибка удаления перенаправления",
                    "already_exist": "Для этого пути уже существует перенаправление"
                },
                "posts": {
                    "create": "Ошибка создания статьи",
                    "update": "Ошибка обновления статьи",
                    "save": "Ошибка сохранения статьи",
                    "delete": "Ошибка удаления статьи"
                }
            },
            "frontend": {
                "user": {
                    "email_taken": "Этот адрес электронной почты уже используется.",
                    "password_mismatch": "Это не ваш старый пароль.",
                    "delete_account": "Ошибка удаления аккаунта.",
                    "updating_disabled": "Редактирование аккаунта отключено."
                },
                "auth": {
                    "registration_disabled": "Регистрация отключена."
                }
            }
        },
        "forms": {
            "contact": {
                "display_name": "Форма обратной связи"
            }
        },
        "labels": {
            "language": "Язык",
            "actions": "Действия",
            "general": "Основные",
            "no_results": "Нет доступных результатов",
            "search": "Искать",
            "validate": "Применить",
            "choose_file": "Выберите файл",
            "no_file_chosen": "Файл не выбран",
            "are_you_sure": "Вы уверены?",
            "delete_image": "Удалить изображение",
            "yes": "Да",
            "no": "Нет",
            "add_new": "Добавить",
            "export": "Экспорт",
            "more_info": "Больше информации",
            "author": "Автор",
            "author_id": "ID автора",
            "last_access_at": "Последний доступ",
            "published_at": "Опубликовано",
            "created_at": "Создано",
            "updated_at": "Обновлено",
            "deleted_at": "Удалено",
            "no_value": "Нет значения",
            "upload_image": "Загрузить изображение",
            "anonymous": "Аноним",
            "all_rights_reserved": "Все права зарезервированы.",
            "with": "с",
            "by": "",
            "datatables": {
                "no_results": "Нет доступных результатов",
                "no_matched_results": "Не найдено подходящих результатов",
                "show_per_page": "Показать",
                "entries_per_page": "записей на страницу",
                "search": "Искать",
                "infos": "Показаны записи с {offset_start} по {offset_end} из {total}"
            },
            "morphs": {
                "post": "Статья, ID {id}",
                "user": "Пользователь, ID {id}"
            },
            "auth": {
                "disabled": "Ваш аккаунт заблокирован."
            },
            "http": {
                "403": {
                    "title": "Доступ запрещён",
                    "description": "Извините, но у вас нет прав доступа к этой странице."
                },
                "404": {
                    "title": "Ресурс не найден",
                    "description": "Извините, но этого ресурса не существует."
                },
                "500": {
                    "title": "Ошибка сервера",
                    "description": "Извините, но сервер столкнулся с ситуацией, которую он не может обработать. Мы исправим это как можно скорее."
                }
            },
            "localization": {
                "en": "Английский",
                "ru": "Русский",
                "fr": "Французский",
                "es": "Испанский",
                "de": "Немецкий",
                "zh": "Китайский",
                "ar": "Арабский",
                "pt": "Португальский"
            },
            "placeholders": {
                "route": "Выберите правильный внутренний маршрут",
                "tags": "Выберите или создайте метку"
            },
            "cookieconsent": {
                "message": "На этом сайте используются файлы cookie, чтобы вам было комфортнее им пользоваться.",
                "dismiss": "Понятно!"
            },
            "descriptions": {
                "allowed_image_types": "Доступные типы: PNG GIF JPG JPEG."
            },
            "user": {
                "dashboard": "Панель управления",
                "remember": "Запомнить",
                "login": "Вход",
                "logout": "Выход",
                "password_forgot": "Забыли пароль?",
                "send_password_link": "Отправить ссылку сброса пароля",
                "password_reset": "Сброс пароля",
                "register": "Регистрация",
                "space": "Моё пространство",
                "settings": "Настройки",
                "account": "Мой аккаунт",
                "profile": "Мой профиль",
                "avatar": "Аватар",
                "online": "В&nbsp;сети",
                "edit_profile": "Изменить мой профиль",
                "change_password": "Изменить мой пароль",
                "delete": "Удалить мой аккаунт",
                "administration": "Администрирование",
                "member_since": "Участник с {date}",
                "profile_updated": "Профиль успешно изменён.",
                "password_updated": "Пароль успешно изменён.",
                "super_admin": "Супер-администратор",
                "account_delete": "<p>Это действие полностью удалит вашу учетную запись с этого сайта, а также все связанные данные.<\/p>",
                "account_deleted": "Аккаунт успешно удалён",
                "titles": {
                    "space": "Моё пространство",
                    "account": "Мой аккаунт"
                }
            },
            "alerts": {
                "login_as": "Вы вошли как <strong>{name}<\/strong>, вы можете обратно войти как <a href=\"{route}\" data-turbolinks=\"false\">{admin}<\/a>."
            },
            "backend": {
                "dashboard": {
                    "new_posts": "Новые статьи",
                    "pending_posts": "Ожидающие одобрения статьи",
                    "published_posts": "Опубликованные статьи",
                    "active_users": "Активные пользователи",
                    "form_submissions": "Заполненные формы",
                    "last_posts": "Последние статьи",
                    "last_published_posts": "Последние публикации",
                    "last_pending_posts": "Последние ожидающие статьи",
                    "last_new_posts": "Последние новые статьи",
                    "all_posts": "Все статьи"
                },
                "new_menu": {
                    "post": "Новая статья",
                    "form_setting": "Новая форма",
                    "user": "Новый пользователь",
                    "role": "Новая роль",
                    "meta": "Новые метаданные",
                    "redirection": "Новое перенаправление"
                },
                "sidebar": {
                    "content": "Управление содержимым",
                    "forms": "Управление формами",
                    "access": "Управление доступом",
                    "seo": "Настройки SEO"
                },
                "titles": {
                    "dashboard": "Панель управления"
                },
                "users": {
                    "titles": {
                        "main": "Пользователи",
                        "index": "Список пользователей",
                        "create": "Создание пользователя",
                        "edit": "Изменение пользователя"
                    },
                    "actions": {
                        "destroy": "Удалить выбранных пользователей",
                        "enable": "Активировать выбранных пользователей",
                        "disable": "Отключить выбранных пользователей"
                    }
                },
                "roles": {
                    "titles": {
                        "main": "Роли",
                        "index": "Список ролей",
                        "create": "Создание роли",
                        "edit": "Изменение роли"
                    }
                },
                "metas": {
                    "titles": {
                        "main": "Метаданные",
                        "index": "Список метаданных",
                        "create": "Создание метаданных",
                        "edit": "Изменение метаданных"
                    },
                    "actions": {
                        "destroy": "Удалить выбранные метаданные"
                    }
                },
                "form_submissions": {
                    "titles": {
                        "main": "Заполнения",
                        "index": "Список заполнений форм",
                        "show": "Детали заполнения формы"
                    },
                    "actions": {
                        "destroy": "Удалить выбранные заполнения"
                    }
                },
                "form_settings": {
                    "titles": {
                        "main": "Формы",
                        "index": "Список форм",
                        "create": "Создание формы",
                        "edit": "Изменение формы"
                    },
                    "descriptions": {
                        "recipients": "Пример: 'webmaster@example.com' или 'sales@example.com,support@example.com'. Для указания нескольких получателей перечислите адреса через запятую.",
                        "message": "Сообщение для показа пользователю после отправки формы. Оставьте пустым, если ничего не надо показывать."
                    }
                },
                "redirections": {
                    "titles": {
                        "main": "Перенаправления",
                        "index": "Список перенаправлений",
                        "create": "Создание перенаправления",
                        "edit": "Изменение перенаправления"
                    },
                    "actions": {
                        "destroy": "Удалить выбранные перенаправления",
                        "enable": "Активировать выбранные перенаправления",
                        "disable": "Отключить выбранные перенаправления"
                    },
                    "types": {
                        "permanent": "Постоянное перенаправление (301)",
                        "temporary": "Временное перенаправление (302)"
                    },
                    "import": {
                        "title": "Импорт CSV-файла",
                        "label": "Выберите CSV-файл для импорта",
                        "description": "Файл должен содержать две колонки с заголовками «source» (исходный) и «target» (целевой), перенаправления будут постоянные по-умолчанию."
                    }
                },
                "posts": {
                    "statuses": {
                        "draft": "Черновик",
                        "pending": "Ожидающее",
                        "published": "Опубликованное"
                    },
                    "titles": {
                        "main": "Статьи",
                        "index": "Список статей",
                        "create": "Создать статью",
                        "edit": "Редактировать статью",
                        "publication": "Параметры публикации"
                    },
                    "descriptions": {
                        "meta_title": "Если оставить пустым, по-умолчанию будет заголовком статьи.",
                        "meta_description": "Если оставить пустым, по умолчанию будет отображаться резюме статьи."
                    },
                    "placeholders": {
                        "body": "Напишите своё содержимое...",
                        "meta_title": "Заголовок статьи",
                        "meta_description": "Резюме статьи"
                    },
                    "actions": {
                        "destroy": "Удалить выбранные статьи",
                        "publish": "Опубликовать выбранные статьи",
                        "pin": "Закрепить выбранные статьи",
                        "promote": "Выделить выбранные статьи"
                    }
                }
            },
            "frontend": {
                "titles": {
                    "home": "Начало",
                    "about": "О нас",
                    "contact": "Контакты",
                    "blog": "Блог",
                    "message_sent": "Сообщение отправлено",
                    "legal_mentions": "Юридическая информация",
                    "administration": "Администрирование"
                },
                "submissions": {
                    "message_sent": "<p>Ваше сообщение успешно отправлено.<\/p>"
                },
                "placeholders": {
                    "locale": "Выберите свой язык",
                    "timezone": "Выберите свой часовой пояс"
                },
                "blog": {
                    "published_at": "Опубликовано {date}",
                    "published_at_with_owner_linkable": "Опубликовано <a href=\"{link}\">{name}<\/a>, {date}",
                    "tags": "Метки"
                }
            }
        },
        "logs": {
            "backend": {
                "users": {
                    "created": "Пользователь ID {user} создан",
                    "updated": "Пользователь ID {user} обновлён",
                    "deleted": "Пользователь ID {user} удалён"
                },
                "form_submissions": {
                    "created": "Заполнение формы ID {form_submission} создано"
                }
            },
            "frontend": []
        },
        "mails": {
            "layout": {
                "hello": "Здравствуйте!",
                "regards": "С уважением",
                "trouble": "Если у вас не получается воспользоваться кнопкой {action}, скопируйте URL ниже и откройте его в удобном вам браузере:",
                "all_rights_reserved": "Все права зарезервированы."
            },
            "password_reset": {
                "subject": "Сброс пароля",
                "intro": "Вам отправлено это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.",
                "action": "Сбросить пароль",
                "outro": "Если вы не запрашивали сброс пароля, просто проигнорируйте это письмо."
            },
            "contact": {
                "subject": "Новое сообщение с сайта",
                "new_contact": "Получено новое сообщение с сайта:"
            },
            "alert": {
                "subject": "[{app_name}] Ошибка приложения",
                "message": "На сервере произошёл сбой со следующим сообщением об ошибке: {message}",
                "trace": "Детали трассировки:"
            }
        },
        "pagination": {
            "previous": "&laquo;&nbsp;Назад",
            "next": "Вперёд&nbsp;&raquo;"
        },
        "passwords": {
            "password": "Пароль должен быть как минимум 6 символов длиной и совпадать с подтверждением.",
            "reset": "Ваш пароль изменён!",
            "sent": "Мы отправили вам на почту ссылку для сброса пароля!",
            "token": "Неверный токен сброса пароля.",
            "user": "У нас нет пользователя с этим почтовым адресом."
        },
        "permissions": {
            "categories": {
                "blog": "Блог",
                "form": "Формы",
                "access": "Доступ",
                "seo": "SEO"
            },
            "access": {
                "backend": {
                    "display_name": "Доступ к бэк-офису",
                    "description": "Доступ к страницам администрирования."
                }
            },
            "view": {
                "form_settings": {
                    "display_name": "Просмотр настроек формы",
                    "description": "Можно просматривать настройки формы."
                },
                "form_submissions": {
                    "display_name": "Просмотр заполнений форм",
                    "description": "Пожно просматривать данные заполнения форм."
                },
                "users": {
                    "display_name": "Просмотр пользователей",
                    "description": "Можно видеть список пользователей."
                },
                "roles": {
                    "display_name": "Просмотр ролей",
                    "description": "Можно видеть список ролей."
                },
                "metas": {
                    "display_name": "Просмотр метаданных",
                    "description": "Можно видеть метаданные."
                },
                "redirections": {
                    "display_name": "Просмотр перенаправлений",
                    "description": "Можно видеть список перенаправлений."
                },
                "posts": {
                    "display_name": "Просмотр всех статей",
                    "description": "Можно видеть все статьи."
                },
                "own": {
                    "posts": {
                        "display_name": "Просмотр своих статей",
                        "description": "Можно видеть свои статьи."
                    }
                }
            },
            "create": {
                "form_settings": {
                    "display_name": "Создание форм",
                    "description": "Можно создавать новые формы."
                },
                "users": {
                    "display_name": "Создание пользователей",
                    "description": "Можно создавать новых пользователей."
                },
                "roles": {
                    "display_name": "Создание ролей",
                    "description": "Можно создавать новые роли."
                },
                "metas": {
                    "display_name": "Создание метаданных",
                    "description": "Можно создавать новые метаданные."
                },
                "redirections": {
                    "display_name": "Создание перенеправлений",
                    "description": "Можно создавать новые перенаправления."
                },
                "posts": {
                    "display_name": "Создание статей",
                    "description": "Можно создавать новые статьи."
                }
            },
            "edit": {
                "form_settings": {
                    "display_name": "Правка форм",
                    "description": "Можно изменять данные форм."
                },
                "users": {
                    "display_name": "Правка пользователей",
                    "description": "Можно изменять данные пользователей."
                },
                "roles": {
                    "display_name": "Правка ролей",
                    "description": "Можно изменять данные ролей."
                },
                "metas": {
                    "display_name": "Правка метаданных",
                    "description": "Можно изменять данные метаданных."
                },
                "redirections": {
                    "display_name": "Правка перенаправлений",
                    "description": "Можно изменять данные перенаправлений."
                },
                "posts": {
                    "display_name": "Правка всех статей",
                    "description": "Можно изменять данные всех статей."
                },
                "own": {
                    "posts": {
                        "display_name": "Правка своих статей",
                        "description": "Можно изменять данные своих статей."
                    }
                }
            },
            "delete": {
                "form_settings": {
                    "display_name": "Удаление форм",
                    "description": "Можно удалять формы."
                },
                "form_submissions": {
                    "display_name": "Удаление заполнений форм",
                    "description": "Можно удалять данные заполнения форм."
                },
                "users": {
                    "display_name": "Удаление пользователей",
                    "description": "Можно удалять пользователей."
                },
                "roles": {
                    "display_name": "Удаление ролей",
                    "description": "Можно удалять роли."
                },
                "metas": {
                    "display_name": "Удаление метаданных",
                    "description": "Можно удалять метаданные."
                },
                "redirections": {
                    "display_name": "Удаление перенаправлений",
                    "description": "Можно удалять перенаправления."
                },
                "posts": {
                    "display_name": "Удаление всех статьи",
                    "description": "Можно удалять все статьи."
                },
                "own": {
                    "posts": {
                        "display_name": "Удаление своих статей",
                        "description": "Можно удалять свои статьи."
                    }
                }
            },
            "publish": {
                "posts": {
                    "display_name": "Публикация статей",
                    "description": "Можно управлять публикацией статей."
                }
            },
            "impersonate": {
                "display_name": "Войти под видом пользователя",
                "description": "Можно войти под видом другого пользователя. Полезно для тестирования."
            }
        },
        "routes": {
            "home": "home",
            "about": "about",
            "contact": "contact",
            "contact-sent": "contact-sent",
            "legal-mentions": "legal-mentions",
            "redactors": "blog\/redactors\/{user}"
        },
        "validation": {
            "accepted": "{attribute} должен быть принят.",
            "active_url": "{attribute} является некорректным URL.",
            "after": "{attribute} должен быть датой после {date}.",
            "after_or_equal": "{attribute} должен быть датой после или равной {date}.",
            "alpha": "{attribute} может содержать только буквы.",
            "alpha_dash": "{attribute} может содержать только буквы, цифры и дефисы.",
            "alpha_num": "{attribute} может содержать только буквы и цифры.",
            "array": "{attribute} должен быть списком.",
            "before": "{attribute} должен быть датой до {date}.",
            "before_or_equal": "{attribute} должен быть датой до или равной {date}.",
            "between": {
                "numeric": "{attribute} должен быть между {min} и {max}.",
                "file": "{attribute} должен быть между {min} и {max} kilobytes.",
                "string": "{attribute} должен быть между {min} и {max} characters.",
                "array": "{attribute} должен содержать от {min} до {max} элементов."
            },
            "boolean": "{attribute} должен быть «истина» или «ложь».",
            "confirmed": "{attribute} подтверждение не совпадает.",
            "date": "{attribute} не является корректной датой.",
            "date_format": "{attribute} не совпадает с форматом {format}.",
            "different": "{attribute} и {other} должны различаться.",
            "digits": "{attribute} должен содержать {digits} цифр.",
            "digits_between": "{attribute} должен быть от {min} до {max} цифр.",
            "dimensions": "{attribute} содержит неверные размеры изображения.",
            "distinct": "{attribute} содержит дублирующее значение.",
            "email": "{attribute} должен быть корректным почтовым адресом.",
            "exists": "выбранный {attribute} неверен.",
            "file": "{attribute} должен быть файлом.",
            "filled": "{attribute} должен быть заполнен.",
            "image": "{attribute} должен быть изображением.",
            "in": "выбранный {attribute} неверен.",
            "in_array": "{attribute} отсутствует в {other}.",
            "integer": "{attribute} должен быть целым.",
            "ip": "{attribute} должен быть корректным IP-адресом.",
            "ipv4": "{attribute} должен быть корректным IPv4-адресом.",
            "ipv6": "{attribute} должен быть корректным IPv6-адресом.",
            "json": "{attribute} должен быть корректной JSON-строкой.",
            "max": {
                "numeric": "{attribute} не может быть более чем {max}.",
                "file": "{attribute} не может быть более чем {max} Кб.",
                "string": "{attribute} не может быть более чем {max} символов.",
                "array": "{attribute} не может содержать более чем {max} значений."
            },
            "mimes": "{attribute} должен быть файлом типа {values}.",
            "mimetypes": "{attribute} должен быть файлом типа {values}.",
            "min": {
                "numeric": "{attribute} должен быть не менее чем {min}.",
                "file": "{attribute} должен быть не менее чем {min} Кб.",
                "string": "{attribute} должен содержать не менее чем {min} символов.",
                "array": "{attribute} должен содержать не менее чем {min} значений."
            },
            "not_in": "выбранный {attribute} неверен.",
            "not_regex": "формат {attribute} неверен.",
            "numeric": "{attribute} должен быть числом.",
            "present": "поле {attribute} должно присутствовать.",
            "regex": "формат {attribute} неверен.",
            "required": "поле {attribute} обязательно.",
            "required_if": "поле {attribute} обязательно, когда {other} равно {value}.",
            "required_unless": "поле {attribute} обязательно, если {other} в {values}.",
            "required_with": "поле {attribute} обязательно, если присутствуют {values}.",
            "required_with_all": "поле {attribute} обязательно, если присутствуют {values}.",
            "required_without": "поле {attribute} обязательно, если отсутствуют {values}.",
            "required_without_all": "поле {attribute} обязательно, если нет ничего из {values}.",
            "same": "{attribute} и {other} должны совпадать.",
            "size": {
                "numeric": "{attribute} должно быть {size}.",
                "file": "{attribute} должно быть {size} Кб.",
                "string": "{attribute} должно быть {size} символов.",
                "array": "{attribute} должно содержать {size} элементов."
            },
            "string": "{attribute} должно быть строкой.",
            "timezone": "{attribute} должно быть корректным часовым поясом.",
            "unique": "{attribute} уже есть в базе.",
            "uploaded": "{attribute} не получилось загрузить.",
            "url": "{attribute} имеет неверный формат.",
            "custom": {
                "attribute-name": {
                    "rule-name": "custom-message"
                }
            },
            "attributes": {
                "name": "Имя",
                "display_name": "Отображаемое имя",
                "username": "Псевдоним",
                "email": "E-mail",
                "first_name": "Имя",
                "last_name": "Фамилия",
                "password": "Пароль",
                "password_confirmation": "Подтверждение пароля",
                "old_password": "Старый пароль",
                "new_password": "Новый пароль",
                "new_password_confirmation": "Подтверждение нового пароля",
                "postal_code": "Почтовы индекс",
                "city": "Город",
                "country": "Страна",
                "address": "Адрес",
                "phone": "Телефон",
                "mobile": "Мобильный",
                "age": "Возраст",
                "sex": "Пол",
                "gender": "Пол",
                "day": "День",
                "month": "Месяц",
                "year": "Год",
                "hour": "Час",
                "minute": "Минута",
                "second": "Секунда",
                "title": "Заголовок",
                "content": "Содержание",
                "description": "Описание",
                "summary": "Резюме",
                "excerpt": "Отрывок",
                "date": "Дата",
                "time": "Время",
                "available": "Доступный",
                "size": "Размер",
                "roles": "Роли",
                "permissions": "Права",
                "active": "Активный",
                "message": "Сообщение",
                "g-recaptcha-response": "Защитный код",
                "locale": "Локализация",
                "route": "Маршрут",
                "url": "URL",
                "form_type": "Тип формы",
                "form_data": "Данные формы",
                "recipients": "Получатели",
                "source_path": "Исходный путь",
                "target_path": "Целевой путь",
                "redirect_type": "Тип переадресации",
                "timezone": "Часовой пояс",
                "order": "Порядок показа",
                "image": "Изображение",
                "status": "Статус",
                "pinned": "Закреплено",
                "promoted": "Выделено",
                "body": "Основная часть",
                "tags": "Метки",
                "published_at": "Опубликовано",
                "unpublished_at": "Снято с публикации",
                "metable_type": "Сущность"
            }
        }
    }
}
