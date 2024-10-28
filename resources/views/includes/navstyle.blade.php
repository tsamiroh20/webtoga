<style>
    .nav-link {
        color: #222021;
        padding: 0.5rem 1rem;
        transition: background-color 0.3s, color 0.3s;
    }
  
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
    }
  
    .nav-link.active { 
        background-color: rgba(255, 255, 255, 0.2);
        color: white;
        font-weight: bold;
        border-bottom: 2px solid white;
    }
  
    .btn-outline-success:hover {
        background-color: green;
        color: white;
    }
  
    .nav-item {
        position: relative;
    }
  
    .nav-item::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background-color: darkgreen;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s;
    }
  
    .nav-link:hover::before {
        opacity: 1;
    }
  
    .nav-link.active::before {
        opacity: 0.5;
    }
</style>