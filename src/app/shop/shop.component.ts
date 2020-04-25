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
  
    confirm_msg = '';
    data_submitted = '';

    // pass form data to orderService
    getShopItems(data): void {
        this.itemService.sendItem(data)
           .subscribe((res) =>
               this.responsedata = res);
    }

    /**
    items: Item[] = [
        {
            id: 1,
            listingDatetime: '20200312T12:00:00',
            status: 'active',
            category: '1',
            brand: '2',
            size: '3',
            color: 'blue',
            condition: 'new',
            description: 'A blue shirt.',
            price: 5
        },
        {
            id: 2,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 13
        },
        {
            id: 3,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 30
        },
        {
            id: 4,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 14
        },
        {
            id: 5,
            listingDatetime: '20200311T12:00:00',
            status: 'sold',
            category: '2',
            brand: '3',
            size: '4',
            color: 'green',
            condition: 'like new',
            description: 'A green shirt.',
            price: 2
        },
    ];
    */
    //constructor() { }

    ngOnInit(): void {
        this.getShopItems('all');
    }

}
