<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

do_action( 'bbp_template_before_topics_loop' ); ?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" class="bbp-topics">
    <li class="bbp-body">

        <?php while ( bbp_topics() ) : bbp_the_topic(); ?>

        <?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

        <?php endwhile; ?>

    </li>

    <li class="bbp-footer">
        <div class="tr">
            <p>
                <span
                    class="td colspan<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
            </p>
        </div><!-- .tr -->
    </li>
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->

<?php do_action( 'bbp_template_after_topics_loop' );