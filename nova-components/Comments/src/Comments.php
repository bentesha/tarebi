<?php

namespace Jamaatech\Comments;

use Laravel\Nova\ResourceTool;

class Comments extends ResourceTool {
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name() {
        return 'Comments';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component() {
        return 'comments';
    }
}
