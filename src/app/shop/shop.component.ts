import { Component, OnInit } from '@angular/core';
import { Item } from '../item';
import { ItemService } from '../item.service';


@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})
export class ShopComponent implements OnInit {
    title = 'Shop';
    url = 'shop';
    
    constructor(private itemService: ItemService) {}

    // Let's create a property to store a response from the back end
    // and try binding it back to the view
    // new Item
    responsedata = new Array<Item>();

    //responsedata = new Item(0, '', '', '', '', '', '', '', '', 0);

    confirm_msg = '';

    // get form data from orderService
    getShopItems(): void {
        this.itemService.getItem('shop')
           .subscribe((res) => {
               var resArr = res['content'];
               for (var i = 0; i < resArr['length']; i++) {
                   this.responsedata[i] = resArr[i];
               }});

        this.confirm_msg = 'length = ' + this.responsedata['length'].toString();
    }

    ngOnInit(): void {
        this.getShopItems();
    }

}
