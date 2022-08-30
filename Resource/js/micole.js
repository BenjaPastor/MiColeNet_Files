


/**
 *  Init Custom File Input
 * ====================================================
 */

$(document).ready(function () {
  bsCustomFileInput.init();
})

/**
 * Disable cerrar modal
 * ====================================================
 */

$(window).on("load", function () {
  $("#modal-default").modal({
    backdrop: "static",
    keyboard: false
  });
});

/**
 * Select Destinatario Componer
 * ====================================================
 */

$("#sel_destinatario").on("change", function (e) {
  e.preventDefault();
  $("#destinatario").val($("#sel_destinatario option:selected").text());
  $("#email_destinatario").val($("#sel_destinatario option:selected").val());
});

/**
 * TempusDominus - TimePicker
 * ====================================================
 */

$(document).ready(function () {
  $(function () {
    $("#timepickerTema").datetimepicker({
      format: "HH:mm",
    });
    $("#timepickerTema2").datetimepicker({
      format: "HH:mm",
    });
  });

  /**
   * FullCalendar Delete Evento
   * ====================================================
   */

  $("#deleteButton").on("click", function (e) {
    e.preventDefault();
    doDelete();
  });

  function doDelete() {
    // delete event

    $("#calendarModal").modal("hide");

    var idaula = $("#idaula").val();
    var idtema = $("#idtema").val();
    var fecha = $("#fecha").val();

    $.ajax({
      url: "delEventoCalendario.php",
      data: "idaula=" + idaula + "&idtema=" + idtema + "&fecha=" + fecha,
      type: "POST",
      success: function () {
        $(location).attr("href", "/view/docente/horarioAula.php");
      },
    });
  }

  /**
   * FullCalendar Delete Evento From Alumno
   * ====================================================
   */

  $("#deleteButtonFromAlumno").on("click", function (e) {
    e.preventDefault();
    doDeleteFromAlumno();
  });

  function doDeleteFromAlumno() {
    $("#calendarModal").modal("hide");
    var idalumno = $("#idalumno").val();
    var idaula = $("#idaula").val();
    var idtema = $("#idtema").val();

    $.ajax({
      url: "delEventoHorarioAlumno.php",
      data: "idalumno=" + idalumno + "&idaula=" + idaula + "&idtema=" + idtema,
      type: "POST",
      success: function () {
        $(location).attr("href", "/view/docente/horarioAlumno.php");
      },
    });
  }

  /**
   * Control Asistencia
   * ====================================================
   */

  $("#fecha_asistencia").on("change", function (e) {
    e.preventDefault();

    var idalumno = $("#idalumno_asistencia").val();
    var fecha = $("#fecha_asistencia").val();

    $.ajax({
      url: "showTemasForAsistencia.php",
      data: "idalumno=" + idalumno + "&fecha_asistencia=" + fecha,
      type: "POST",

      success: function (result) {
        let asignaturas = "";

        $.each(JSON.parse(result), function (key, value) {
          if (value["alasasistencia"] == "0") {
            var checkedForYes = "";
            var checkedForNo = "checked";
          } else {
            var checkedForYes = "checked";
            var checkedForNo = "";
          }
          asignaturas +=
            '<h4 class="profile-username ">' + value["tanombre"] + " </h4>";

          asignaturas +=
            '<div class="form-check form-check-inline"><div class="custom-control custom-radio col-md-6"><input class="custom-control-input radio-inline" type="radio" id="asistencia_radio_si' +
            key +
            '" name="asistencia_radio' +
            key +
            '" value="1" ' +
            checkedForYes +
            '><label for="asistencia_radio_si' +
            key +
            '" class="custom-control-label">Sí</label></div>';
          asignaturas +=
            '<div class="custom-control custom-radio form-check form-check-inline"><input class="custom-control-input radio-inline" type="radio" id="asistencia_radio_no' +
            key +
            '" name="asistencia_radio' +
            key +
            '" value="0" ' +
            checkedForNo +
            '><label for="asistencia_radio_no' +
            key +
            '" class="custom-control-label">No</label></div></div>';
          asignaturas +=
            '<button  type="submit" class="btn btn-primary btn-sm float-right" name="enviar+' +
            key +
            '" id="enviar_asistencia" href="" radio_id="' +
            key +
            '" tema_id="' +
            value["tid"] +
            '" alumno_id="' +
            value["alasIDALUMNO"] +
            '" aula_id="' +
            value["alasIDAULA"] +
            '"> Guardar</button>';
        });

        $(document).on("click", "#enviar_asistencia", function () {
          var asistencia = $("input[type=radio]:checked")
            .eq($(this).attr("radio_id"))
            .val();

          var idalumno = $(this).attr("alumno_id");
          var idaula = $(this).attr("aula_id");
          var idtema = $(this).attr("tema_id");

          $.ajax({
            url: "updateAsistenciaAlumno.php",
            data:
              "asistencia=" +
              asistencia +
              "&idalumno=" +
              idalumno +
              "&idaula=" +
              idaula +
              "&idtema=" +
              idtema,
            type: "POST",
            success: function () {
              $("#modalOk").modal("show");
              //$(location).attr("href", "/view/docente/horarioAula.php");
            },
          });
        });

        $("#control_asistencia").html(asignaturas);
      },
      error: function () {
        alert("Ups");
      },
    });
  });

  /**
   * Ajax - Select Curso - Asignatura - Tema
   * ====================================================
   */

  $("#sel_curso").change(function () {
    var cursoid = $(this).val();

    $.ajax({
      url: "/view/docente/getAsignaturas.php",
      type: "post",
      data: { curso: cursoid },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        $("#sel_asignaturas").append(
          "<option value='0'>-Seleccione Asignatura- </option>"
        );
        $("#sel_asignaturas").empty();
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var nombre = response[i]["nombre"];

          $("#sel_asignaturas").append(
            "<option value='" + id + "'>" + nombre + "</option>"
          );
        }
      },
    });
  });

  $("#sel_asignaturas").change(function () {
    var asignaturaid = $(this).val();

    $.ajax({
      url: "/view/docente/getTemario.php",
      type: "post",
      data: { asignatura: asignaturaid },
      dataType: "json",
      success: function (response) {
        var len = response.length;

        $("#sel_tema").empty();
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var nombre = response[i]["nombre"];

          $("#sel_tema").append(
            "<option value='" + id + "'>" + nombre + "</option>"
          );
        }
      },
    });
  });

  $("#sel_asig_alumno").change(function () {
    var asignaturaid = $(this).val();

    $.ajax({
      url: "/view/docente/getTemarioAlumno.php",
      type: "post",
      data: { asignatura: asignaturaid },
      dataType: "json",
      success: function (response) {
        var len = response.length;

        $("#sel_tema").empty();
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var nombre = response[i]["nombre"];

          $("#sel_tema").append(
            "<option value='" + id + "'>" + nombre + "</option>"
          );
        }
      },
    });
  });
  $("#sel_tema").change(function () {
    var sel_tema = $(this).val();

    $.ajax({
      url: "/view/docente/getAulaTemario.php",
      type: "post",
      data: { sel_tema: sel_tema },
      dataType: "json",
      success: function (response) {
        var len = response.length;
        for (var i = 0; i < len; i++) {
          var id = response[i]["id"];
          var nombre = response[i]["nombre"];
          $("#IDAULA").val(nombre);
        }
      },
    });
  });
});

(function (global, factory) {
  typeof exports === "object" && typeof module !== "undefined"
    ? factory(exports)
    : typeof define === "function" && define.amd
    ? define(["exports"], factory)
    : ((global = global || self), factory((global.adminlte = {})));
})(this, function (exports) {
  "use strict";

  //Ocultar Menu ( Sidebar )
  var ControlSidebar = (function ($) {
    /**
     * Constants
     * ====================================================
     */
    var NAME = "ControlSidebar";
    var DATA_KEY = "lte.controlsidebar";
    var EVENT_KEY = "." + DATA_KEY;
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Event = {
      COLLAPSED: "collapsed" + EVENT_KEY,
      EXPANDED: "expanded" + EVENT_KEY,
    };
    var Selector = {
      CONTROL_SIDEBAR: ".control-sidebar",
      CONTROL_SIDEBAR_CONTENT: ".control-sidebar-content",
      DATA_TOGGLE: '[data-widget="control-sidebar"]',
      CONTENT: ".content-wrapper",
      HEADER: ".main-header",
      FOOTER: ".main-footer",
    };
    var ClassName = {
      CONTROL_SIDEBAR_ANIMATE: "control-sidebar-animate",
      CONTROL_SIDEBAR_OPEN: "control-sidebar-open",
      CONTROL_SIDEBAR_SLIDE: "control-sidebar-slide-open",
      LAYOUT_FIXED: "layout-fixed",
      NAVBAR_FIXED: "layout-navbar-fixed",
      NAVBAR_SM_FIXED: "layout-sm-navbar-fixed",
      NAVBAR_MD_FIXED: "layout-md-navbar-fixed",
      NAVBAR_LG_FIXED: "layout-lg-navbar-fixed",
      NAVBAR_XL_FIXED: "layout-xl-navbar-fixed",
      FOOTER_FIXED: "layout-footer-fixed",
      FOOTER_SM_FIXED: "layout-sm-footer-fixed",
      FOOTER_MD_FIXED: "layout-md-footer-fixed",
      FOOTER_LG_FIXED: "layout-lg-footer-fixed",
      FOOTER_XL_FIXED: "layout-xl-footer-fixed",
    };
    var Default = {
      controlsidebarSlide: true,
      scrollbarTheme: "os-theme-light",
      scrollbarAutoHide: "l",
    };
    /**
     * Class Definition
     * ====================================================
     */

    var ControlSidebar =
      /*#__PURE__*/
      (function () {
        function ControlSidebar(element, config) {
          this._element = element;
          this._config = config;

          this._init();
        } // Public

        var _proto = ControlSidebar.prototype;

        _proto.collapse = function collapse() {
          // Show the control sidebar
          if (this._config.controlsidebarSlide) {
            $("html").addClass(ClassName.CONTROL_SIDEBAR_ANIMATE);
            $("body")
              .removeClass(ClassName.CONTROL_SIDEBAR_SLIDE)
              .delay(300)
              .queue(function () {
                $(Selector.CONTROL_SIDEBAR).hide();
                $("html").removeClass(ClassName.CONTROL_SIDEBAR_ANIMATE);
                $(this).dequeue();
              });
          } else {
            $("body").removeClass(ClassName.CONTROL_SIDEBAR_OPEN);
          }

          var collapsedEvent = $.Event(Event.COLLAPSED);
          $(this._element).trigger(collapsedEvent);
        };

        _proto.show = function show() {
          // Collapse the control sidebar
          if (this._config.controlsidebarSlide) {
            $("html").addClass(ClassName.CONTROL_SIDEBAR_ANIMATE);
            $(Selector.CONTROL_SIDEBAR)
              .show()
              .delay(10)
              .queue(function () {
                $("body")
                  .addClass(ClassName.CONTROL_SIDEBAR_SLIDE)
                  .delay(300)
                  .queue(function () {
                    $("html").removeClass(ClassName.CONTROL_SIDEBAR_ANIMATE);
                    $(this).dequeue();
                  });
                $(this).dequeue();
              });
          } else {
            $("body").addClass(ClassName.CONTROL_SIDEBAR_OPEN);
          }

          var expandedEvent = $.Event(Event.EXPANDED);
          $(this._element).trigger(expandedEvent);
        };

        _proto.toggle = function toggle() {
          var shouldClose =
            $("body").hasClass(ClassName.CONTROL_SIDEBAR_OPEN) ||
            $("body").hasClass(ClassName.CONTROL_SIDEBAR_SLIDE);

          if (shouldClose) {
            // Close the control sidebar
            this.collapse();
          } else {
            // Open the control sidebar
            this.show();
          }
        }; // Private

        _proto._init = function _init() {
          var _this = this;

          this._fixHeight();

          this._fixScrollHeight();

          $(window).resize(function () {
            _this._fixHeight();

            _this._fixScrollHeight();
          });
          $(window).scroll(function () {
            if (
              $("body").hasClass(ClassName.CONTROL_SIDEBAR_OPEN) ||
              $("body").hasClass(ClassName.CONTROL_SIDEBAR_SLIDE)
            ) {
              _this._fixScrollHeight();
            }
          });
        };

        _proto._fixScrollHeight = function _fixScrollHeight() {
          var heights = {
            scroll: $(document).height(),
            window: $(window).height(),
            header: $(Selector.HEADER).outerHeight(),
            footer: $(Selector.FOOTER).outerHeight(),
          };
          var positions = {
            bottom: Math.abs(
              heights.window + $(window).scrollTop() - heights.scroll
            ),
            top: $(window).scrollTop(),
          };
          var navbarFixed = false;
          var footerFixed = false;

          if ($("body").hasClass(ClassName.LAYOUT_FIXED)) {
            if (
              $("body").hasClass(ClassName.NAVBAR_FIXED) ||
              $("body").hasClass(ClassName.NAVBAR_SM_FIXED) ||
              $("body").hasClass(ClassName.NAVBAR_MD_FIXED) ||
              $("body").hasClass(ClassName.NAVBAR_LG_FIXED) ||
              $("body").hasClass(ClassName.NAVBAR_XL_FIXED)
            ) {
              if ($(Selector.HEADER).css("position") === "fixed") {
                navbarFixed = true;
              }
            }

            if (
              $("body").hasClass(ClassName.FOOTER_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_SM_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_MD_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_LG_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_XL_FIXED)
            ) {
              if ($(Selector.FOOTER).css("position") === "fixed") {
                footerFixed = true;
              }
            }

            if (positions.top === 0 && positions.bottom === 0) {
              $(Selector.CONTROL_SIDEBAR).css("bottom", heights.footer);
              $(Selector.CONTROL_SIDEBAR).css("top", heights.header);
              $(
                Selector.CONTROL_SIDEBAR +
                  ", " +
                  Selector.CONTROL_SIDEBAR +
                  " " +
                  Selector.CONTROL_SIDEBAR_CONTENT
              ).css(
                "height",
                heights.window - (heights.header + heights.footer)
              );
            } else if (positions.bottom <= heights.footer) {
              if (footerFixed === false) {
                $(Selector.CONTROL_SIDEBAR).css(
                  "bottom",
                  heights.footer - positions.bottom
                );
                $(
                  Selector.CONTROL_SIDEBAR +
                    ", " +
                    Selector.CONTROL_SIDEBAR +
                    " " +
                    Selector.CONTROL_SIDEBAR_CONTENT
                ).css(
                  "height",
                  heights.window - (heights.footer - positions.bottom)
                );
              } else {
                $(Selector.CONTROL_SIDEBAR).css("bottom", heights.footer);
              }
            } else if (positions.top <= heights.header) {
              if (navbarFixed === false) {
                $(Selector.CONTROL_SIDEBAR).css(
                  "top",
                  heights.header - positions.top
                );
                $(
                  Selector.CONTROL_SIDEBAR +
                    ", " +
                    Selector.CONTROL_SIDEBAR +
                    " " +
                    Selector.CONTROL_SIDEBAR_CONTENT
                ).css(
                  "height",
                  heights.window - (heights.header - positions.top)
                );
              } else {
                $(Selector.CONTROL_SIDEBAR).css("top", heights.header);
              }
            } else {
              if (navbarFixed === false) {
                $(Selector.CONTROL_SIDEBAR).css("top", 0);
                $(
                  Selector.CONTROL_SIDEBAR +
                    ", " +
                    Selector.CONTROL_SIDEBAR +
                    " " +
                    Selector.CONTROL_SIDEBAR_CONTENT
                ).css("height", heights.window);
              } else {
                $(Selector.CONTROL_SIDEBAR).css("top", heights.header);
              }
            }
          }
        };

        _proto._fixHeight = function _fixHeight() {
          var heights = {
            window: $(window).height(),
            header: $(Selector.HEADER).outerHeight(),
            footer: $(Selector.FOOTER).outerHeight(),
          };

          if ($("body").hasClass(ClassName.LAYOUT_FIXED)) {
            var sidebarHeight = heights.window - heights.header;

            if (
              $("body").hasClass(ClassName.FOOTER_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_SM_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_MD_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_LG_FIXED) ||
              $("body").hasClass(ClassName.FOOTER_XL_FIXED)
            ) {
              if ($(Selector.FOOTER).css("position") === "fixed") {
                sidebarHeight =
                  heights.window - heights.header - heights.footer;
              }
            }

            $(
              Selector.CONTROL_SIDEBAR + " " + Selector.CONTROL_SIDEBAR_CONTENT
            ).css("height", sidebarHeight);

            if (typeof $.fn.overlayScrollbars !== "undefined") {
              $(
                Selector.CONTROL_SIDEBAR +
                  " " +
                  Selector.CONTROL_SIDEBAR_CONTENT
              ).overlayScrollbars({
                className: this._config.scrollbarTheme,
                sizeAutoCapable: true,
                scrollbars: {
                  autoHide: this._config.scrollbarAutoHide,
                  clickScrolling: true,
                },
              });
            }
          }
        }; // Static

        ControlSidebar._jQueryInterface = function _jQueryInterface(operation) {
          return this.each(function () {
            var data = $(this).data(DATA_KEY);

            var _options = $.extend({}, Default, $(this).data());

            if (!data) {
              data = new ControlSidebar(this, _options);
              $(this).data(DATA_KEY, data);
            }

            if (data[operation] === "undefined") {
              throw new Error(operation + " is not a function");
            }

            data[operation]();
          });
        };

        return ControlSidebar;
      })();
    /**
     *
     * Data Api implementation
     * ====================================================
     */

    $(document).on("click", Selector.DATA_TOGGLE, function (event) {
      event.preventDefault();

      ControlSidebar._jQueryInterface.call($(this), "toggle");
    });
    /**
     * jQuery API
     * ====================================================
     */

    $.fn[NAME] = ControlSidebar._jQueryInterface;
    $.fn[NAME].Constructor = ControlSidebar;

    $.fn[NAME].noConflict = function () {
      $.fn[NAME] = JQUERY_NO_CONFLICT;
      return ControlSidebar._jQueryInterface;
    };

    return ControlSidebar;
  })(jQuery);

  /**
   * --------------------------------------------
   * Treeview.js
   * --------------------------------------------
   */
  var Treeview = (function ($) {
    /**
     * Constants
     * ====================================================
     */
    var NAME = "Treeview";
    var DATA_KEY = "lte.treeview";
    var EVENT_KEY = "." + DATA_KEY;
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Event = {
      SELECTED: "selected" + EVENT_KEY,
      EXPANDED: "expanded" + EVENT_KEY,
      COLLAPSED: "collapsed" + EVENT_KEY,
      LOAD_DATA_API: "load" + EVENT_KEY,
    };
    var Selector = {
      LI: ".nav-item",
      LINK: ".nav-link",
      TREEVIEW_MENU: ".nav-treeview",
      OPEN: ".menu-open",
      DATA_WIDGET: '[data-widget="treeview"]',
    };
    var ClassName = {
      LI: "nav-item",
      LINK: "nav-link",
      TREEVIEW_MENU: "nav-treeview",
      OPEN: "menu-open",
      SIDEBAR_COLLAPSED: "sidebar-collapse",
    };
    var Default = {
      trigger: Selector.DATA_WIDGET + " " + Selector.LINK,
      animationSpeed: 300,
      accordion: true,
      expandSidebar: false,
      sidebarButtonSelector: '[data-widget="pushmenu"]',
    };
    /**
     * Class Definition
     * ====================================================
     */

    var Treeview =
      /*#__PURE__*/
      (function () {
        function Treeview(element, config) {
          this._config = config;
          this._element = element;
        } // Public

        var _proto = Treeview.prototype;

        _proto.init = function init() {
          this._setupListeners();
        };

        _proto.expand = function expand(treeviewMenu, parentLi) {
          var _this = this;

          var expandedEvent = $.Event(Event.EXPANDED);

          if (this._config.accordion) {
            var openMenuLi = parentLi.siblings(Selector.OPEN).first();
            var openTreeview = openMenuLi.find(Selector.TREEVIEW_MENU).first();
            this.collapse(openTreeview, openMenuLi);
          }

          treeviewMenu
            .stop()
            .slideDown(this._config.animationSpeed, function () {
              parentLi.addClass(ClassName.OPEN);
              $(_this._element).trigger(expandedEvent);
            });

          if (this._config.expandSidebar) {
            this._expandSidebar();
          }
        };

        _proto.collapse = function collapse(treeviewMenu, parentLi) {
          var _this2 = this;

          var collapsedEvent = $.Event(Event.COLLAPSED);
          treeviewMenu.stop().slideUp(this._config.animationSpeed, function () {
            parentLi.removeClass(ClassName.OPEN);
            $(_this2._element).trigger(collapsedEvent);
            treeviewMenu
              .find(Selector.OPEN + " > " + Selector.TREEVIEW_MENU)
              .slideUp();
            treeviewMenu.find(Selector.OPEN).removeClass(ClassName.OPEN);
          });
        };

        _proto.toggle = function toggle(event) {
          var $relativeTarget = $(event.currentTarget);
          var $parent = $relativeTarget.parent();
          var treeviewMenu = $parent.find("> " + Selector.TREEVIEW_MENU);

          if (!treeviewMenu.is(Selector.TREEVIEW_MENU)) {
            if (!$parent.is(Selector.LI)) {
              treeviewMenu = $parent
                .parent()
                .find("> " + Selector.TREEVIEW_MENU);
            }

            if (!treeviewMenu.is(Selector.TREEVIEW_MENU)) {
              return;
            }
          }

          event.preventDefault();
          var parentLi = $relativeTarget.parents(Selector.LI).first();
          var isOpen = parentLi.hasClass(ClassName.OPEN);

          if (isOpen) {
            this.collapse($(treeviewMenu), parentLi);
          } else {
            this.expand($(treeviewMenu), parentLi);
          }
        }; // Private

        _proto._setupListeners = function _setupListeners() {
          var _this3 = this;

          $(document).on("click", this._config.trigger, function (event) {
            _this3.toggle(event);
          });
        };

        _proto._expandSidebar = function _expandSidebar() {
          if ($("body").hasClass(ClassName.SIDEBAR_COLLAPSED)) {
            $(this._config.sidebarButtonSelector).PushMenu("expand");
          }
        }; // Static

        Treeview._jQueryInterface = function _jQueryInterface(config) {
          return this.each(function () {
            var data = $(this).data(DATA_KEY);

            var _options = $.extend({}, Default, $(this).data());

            if (!data) {
              data = new Treeview($(this), _options);
              $(this).data(DATA_KEY, data);
            }

            if (config === "init") {
              data[config]();
            }
          });
        };

        return Treeview;
      })();
    /**
     * Data API
     * ====================================================
     */

    $(window).on(Event.LOAD_DATA_API, function () {
      $(Selector.DATA_WIDGET).each(function () {
        Treeview._jQueryInterface.call($(this), "init");
      });
    });
    /**
     * jQuery API
     * ====================================================
     */

    $.fn[NAME] = Treeview._jQueryInterface;
    $.fn[NAME].Constructor = Treeview;

    $.fn[NAME].noConflict = function () {
      $.fn[NAME] = JQUERY_NO_CONFLICT;
      return Treeview._jQueryInterface;
    };

    return Treeview;
  })(jQuery);

  /**
   * --------------------------------------------
   * Dropdown.js
   * --------------------------------------------
   */
  var Dropdown = (function ($) {
    /**
     * Constants
     * ====================================================
     */
    var NAME = "Dropdown";
    var DATA_KEY = "lte.dropdown";
    var JQUERY_NO_CONFLICT = $.fn[NAME];
    var Selector = {
      DROPDOWN_MENU: "ul.dropdown-menu",
      DROPDOWN_TOGGLE: '[data-toggle="dropdown"]',
    };
    var Default = {};
    /**
     * Class Definition
     * ====================================================
     */

    var Dropdown =
      /*#__PURE__*/
      (function () {
        function Dropdown(element, config) {
          this._config = config;
          this._element = element;
        } // Public

        var _proto = Dropdown.prototype;

        _proto.toggleSubmenu = function toggleSubmenu() {
          this._element.siblings().show().toggleClass("show");

          if (!this._element.next().hasClass("show")) {
            this._element
              .parents(".dropdown-menu")
              .first()
              .find(".show")
              .removeClass("show")
              .hide();
          }

          this._element
            .parents("li.nav-item.dropdown.show")
            .on("hidden.bs.dropdown", function (e) {
              $(".dropdown-submenu .show").removeClass("show").hide();
            });
        }; // Static

        Dropdown._jQueryInterface = function _jQueryInterface(config) {
          return this.each(function () {
            var data = $(this).data(DATA_KEY);

            var _config = $.extend({}, Default, $(this).data());

            if (!data) {
              data = new Dropdown($(this), _config);
              $(this).data(DATA_KEY, data);
            }

            if (config === "toggleSubmenu") {
              data[config]();
            }
          });
        };

        return Dropdown;
      })();
    /**
     * Data API
     * ====================================================
     */

    $(Selector.DROPDOWN_MENU + " " + Selector.DROPDOWN_TOGGLE).on(
      "click",
      function (event) {
        event.preventDefault();
        event.stopPropagation();

        Dropdown._jQueryInterface.call($(this), "toggleSubmenu");
      }
    ); // $(Selector.SIDEBAR + ' a').on('focusin', () => {
    //   $(Selector.MAIN_SIDEBAR).addClass(ClassName.SIDEBAR_FOCUSED);
    // })
    // $(Selector.SIDEBAR + ' a').on('focusout', () => {
    //   $(Selector.MAIN_SIDEBAR).removeClass(ClassName.SIDEBAR_FOCUSED);
    // })

    /**
     * jQuery API
     * ====================================================
     */

    $.fn[NAME] = Dropdown._jQueryInterface;
    $.fn[NAME].Constructor = Dropdown;

    $.fn[NAME].noConflict = function () {
      $.fn[NAME] = JQUERY_NO_CONFLICT;
      return Dropdown._jQueryInterface;
    };

    return Dropdown;
  })(jQuery);
});
