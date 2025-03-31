import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import Edit from './edit';
import save from './save';

registerBlockType('fwd-blocks/animate-block', {
    apiVersion: 2,
    title: __('Animate Block', 'school'),
    description: __('A block that adds scroll animations to its content.', 'school'),
    category: 'design',
    icon: 'animation',
    supports: {
        html: false
    },
    attributes: {
        animationType: {
            type: 'string',
            default: 'fade-up'
        }
    },
    edit: Edit,
    save
}); 