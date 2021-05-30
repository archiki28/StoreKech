var price=11;

paypal.Buttons({
    style:{
        color:"blue",
        shape:"pill"

    },
    createOrder:function(data,actions){
        return actions.order.create({
            purchase_units:[{
                amount:{
                    value:Allprice
                }
            }]
        })
    },
    onApprove:function(data,actions){
        return actions.order.capture().then(function(details){
            console.log(details)
        })
    }
}).render('.paypal');