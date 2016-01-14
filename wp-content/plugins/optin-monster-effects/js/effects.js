/* ==========================================================
 * effects.js
 * http://optinmonster.com/
 * ==========================================================
 * Copyright 2014 Thomas Griffin.
 *
 * Licensed under the GPL License, Version 2.0 or later (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */
;(function($){
    $(function(){
        // Load the custom optin effect when selected.
        $(document).on('change', '#optin-monster-field-effect', function(){
            var data = {
                action: 'load_optin_effect',
                effect: $(this).val(),
                id:     optin_monster_edit.id
            };
            $('.fa-spinner').fadeTo(0, 1);
            $.post(optin_monster_edit.ajax, data, function(res){
                var frame  = $('#optin-monster-preview').contents(),
                    effect = $('.om-effect-output', frame);
                if ( effect.length === 0 ) {
                    $('.om-theme-' + res.theme, frame).before(res.effect);
                } else {
                    effect.remove();
                    $('.om-theme-' + res.theme, frame).before(res.effect);
                }
                $('.fa-spinner').fadeTo(300, 0);
            }, 'json');
        });
    });
}(jQuery));