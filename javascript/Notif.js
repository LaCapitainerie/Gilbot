function notif() {
    if(document.querySelector('#notif')){
        window.setInterval(function(){
            const notification = (document.querySelector('#notif')?.checked);
            document.querySelector('link[rel=icon]').href = `../${notification?"Img/logo_notif.png":"favicon.ico"}`;
            console.log(notification);
        }, 5000);
    };
};

