<?php

/**
 * Notes Block
 * 
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

class Notes_Block
{   
    /**
     * Constructor.
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action( 'init', array( $this, 'register_block' ) );
    }

    /**
     * Register the block.
     * 
     * @since 1.0.0
     */
    public function register_block()
    {
        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }

        register_block_type(
            'wpt/notes',
            array(
                'render_callback' => array( $this, 'render' ),
                'attributes'      => array(
                    'id' => array(
                        'type' => 'string',
                    ),
                ),
            )
        );
    }

    /**
     * Render the block.
     * 
     * @since 1.0.0
     */
    public function render( $attributes )
    {
        $id = $attributes['id'];
        
        $classes = isset( $attributes['className'] ) ? $attributes['className'] : '';

        $notes = wpt_all_notes();

        // Turn on output buffering
    	ob_start(); 

        ?>

        <div id="<?php echo $attributes['id']; ?>-wpt-notes" class="wpt-notes-block <?php echo $classes; ?>">
            <div class="wpt-notes-container">
                <?php 
                    foreach( $notes as $note ) :
                ?>
                <article class="note">
                    <h2 class="title"><?php echo $note['title'] ?></h2>
                </article>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    
        // Collect output
    	$output = ob_get_contents(); 

        // Turn off ouput buffer
    	ob_end_clean(); 

    	return $output;
    }
}

new Notes_Block();
