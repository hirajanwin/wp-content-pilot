/**
 * WP Content Pilot Admin
 * https://www.pluginever.com
 *
 * Copyright (c) 2019 pluginever
 * Licensed under the GPLv2+ license.
 */

/*jslint browser: true */
/*global jQuery:false */
/*global confirm:false */
jQuery(document).ready(function ($) {
	'use strict';
	$.wp_content_pilot = {

		init: function () {
			$('.wpcp-tooltip').tipTip({
				'attribute': 'data-tip',
				'fadeIn': 50,
				'fadeOut': 50,
				'delay': 200
			});
			$('.wpcp-range-slider').ionRangeSlider({
				skin: 'round'
			});

			$('.wpcp-select2').select2({
				theme: 'default wpcp-select2'
			});
		},
		spinner:function () {
			$(this).hide();
			$(this).prev('.spinner').show().addClass('is-active');
			$('.publishing-action-btn .button').attr('disabled', 'disabled');
		},
		hideKeywordField:function(){
			var keywordInput = $('#_keywords');
			var suggestionInput = $('#_keyword_suggestion');
			var keywordWrapper = keywordInput.closest('p._keywords-field');
			var suggestionWrapper = suggestionInput.closest('p._keyword_suggestion-field');
			keywordInput.attr('disabled', 'disabled');
			suggestionInput.attr('disabled', 'disabled');
			keywordWrapper.hide();
			suggestionWrapper.hide();
		},
		showKeywordField:function(){
			var keywordInput = $('#_keywords');
			var suggestionInput = $('#_keyword_suggestion');
			var keywordWrapper = keywordInput.closest('p._keywords-field');
			var suggestionWrapper = suggestionInput.closest('p._keyword_suggestion-field');
			keywordInput.removeAttr('disabled');
			suggestionInput.removeAttr('disabled');
			keywordWrapper.show();
			suggestionWrapper.show();
		},
		youtube: function () {
			$('#_youtube_search_type').on('change', function () {
				var channnelField = $('._youtube_playlist_id-field');
				if('global' === $(this).val()){
					channnelField.hide();
					$.wp_content_pilot.showKeywordField();
				}else{
					channnelField.show();
					$.wp_content_pilot.hideKeywordField();
				}
			}).change();
		},
		deleteCampaignPosts:function (e) {
			e.preventDefault();

			if (!confirm('Are you sure?')) {
				return;
			}

			var $el     = $(this),
				spinner = $(this).next(),
				camp_id = $el.data('campid'),
				nonce   = $el.data('nonce');

			$el.attr('disabled', true);
			spinner.addClass('active');
			$el.attr('disabled', true);
			spinner.addClass('active');

			wp.ajax.send({
				data: {
					action: 'wpcp_delete_all_campaign_posts',
					camp_id: camp_id,
					nonce: nonce
				},
				success: function () {
					spinner.removeClass('active');
					$el.attr('disabled', false);
					spinner.removeClass('active');
					$el.attr('disabled', false);
					window.location.reload();
				},
				error: function (error) {
					$el.attr('disabled', false);
					console.log(error);
				}
			});
		},
		clearLogs:function (e) {
			e.preventDefault();

			if (!confirm('Are you sure?')) {
				return;
			}

			var $el     = $(this),
				nonce   = $el.data('nonce');
			wp.ajax.send({
				data: {
					action: 'wpcp_clear_logs',
					nonce: nonce
				},
				success: function () {
					$el.attr('disabled', false);
					window.location.reload();
				},
				error: function (error) {
					$el.attr('disabled', false);
					console.log(error);
				}
			});
		}

	};
	$.wp_content_pilot.init();
	$.wp_content_pilot.youtube();
	$('#wpcp-run-campaign').on('click', $.wp_content_pilot.spinner);
	$('#wpcp-delete-campaign-posts').on('click', $.wp_content_pilot.deleteCampaignPosts);
	$('#wpcp-clear-logs').on('click', $.wp_content_pilot.clearLogs);
});
