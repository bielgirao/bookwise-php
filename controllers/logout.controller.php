<?php
    
    session_destroy();
    session_start();
    
    flash()->push('message', 'Logged out successfully!');
    redirect('/login');