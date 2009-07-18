/**
 * recursive.js
 *
 */
var recursive = 1;
var selectModel = null;
$(function(){

      setColor(recursive);

      $('.model').click(function(){
                            $('div.model').css({
                                                   display:'none',
                                                   border:'1px solid #ccc'
                                               });
                            selectModel = this;
                            findAssoc(this,recursive);
                        });
      $('div#reset').click(function(){
                               $('div.model').css({
                                                      display:'block',
                                                      border:'1px solid #ccc'
                                                  });
                           });

      $('#recursive li').click(function(){
                                   recursive = parseInt($(this).text());
                                   setColor(recursive);
                                   if (selectModel) {
                            $('div.model').css({
                                                   display:'none',
                                                   border:'1px solid #ccc'
                                               });
                                       findAssoc(selectModel,recursive);
                                   }
                               });
  });

function setColor(rec) {
    //console.log(rec);
    $('#recursive li').css({backgroundColor:"#f4f4f4"});
    $('#recursive li').eq(rec + 1).css({backgroundColor:"#EF3021"});
}

function findAssoc(elm,rec) {

    var color = ["#EF3021","#003C4B","#CECF63"];

    if (rec < 0) {
        if (recursive == -1) {
        $(elm).css({
                       display:'block',
                       border:'2px solid ' + color[0]
                   });
        }
        return false;
    }

    if ($(elm).css('border').match(/1px/) == '1px') {
        $(elm).css({
                       display:'block',
                       border:'2px solid ' + color[recursive - rec]
                   });
    }

    switch(recursive) {
    case -1:
        break;
    case 0:
        switch (rec) {
        case 0:
            rec--;
            belongsTo();
            hasOne();
            break;
        }
        break;
    case 1:
        switch (rec) {
        case 0:
            break;
        case 1:
            rec--;
            belongsTo();
            hasOne();
            hasMany();
            hasAndBelongsToMany();
            break;
        }
        break;
    case 2:
        switch (rec) {
        case 0:
            break;
        case 1:
            rec--;
            belongsTo();
            hasOne();
            hasMany();
            hasAndBelongsToMany();
            break;
        case 2:
            rec--;
            belongsTo();
            hasOne();
            hasMany();
            hasAndBelongsToMany();
            break;
        }
        break;
    }

    function belongsTo() {
        $(elm).find('tr.belongsTo').each(function(){
                                             var className = $.trim($(this).find('td.className').text());
                                             if (className != $(elm).attr('id')) {
                                                 $('div#' + className).css({display:'block'});
                                                 findAssoc($('div#' + className),rec);
                                             }
                                         });
    }

    function hasOne() {
        $(elm).find('tr.hasOne').each(function(){
                                          var className = $.trim($(this).find('td.className').text());
                                          if (className != $(elm).attr('id')) {
                                              $('div#' + className).css({display:'block'});
                                              findAssoc($('div#' + className),rec);
                                          }
                                      });
    }

    function hasMany() {
        $(elm).find('tr.hasMany').each(function(){
                                           var className = $.trim($(this).find('td.className').text());
                                           if (className != $(elm).attr('id')) {
                                               $('div#' + className).css({display:'block'});
                                               findAssoc($('div#' + className),rec);
                                           }
                                       });
    }

    function hasAndBelongsToMany() {
        $(elm).find('tr.hasAndBelongsToMany').each(function(){
                                                       var className = $.trim($(this).find('td.className').text());
                                                       if (className != $(elm).attr('id')) {
                                                           $('div#' + className).css({display:'block'});
                                                           findAssoc($('div#' + className),rec);
                                                       }
                                                   });
    }


    return true;

}