import { Component, OnInit } from '@angular/core';
import { Item } from '../item';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';


@Component({
  selector: 'app-shop',
  templateUrl: './shop.component.html',
  styleUrls: ['./shop.component.css']
})
export class ShopComponent implements OnInit {
    title = 'Shop';
    url = 'shop';
    
    constructor(private http: HttpClient) {  
        this.getShopItems();
     }

    // Let's create a property to store a response from the back end
    // and try binding it back to the view
    // new Item
    responsedata = new Array<Item>();
  
    confirm_msg = '';
    data_submitted = '';
  
    // Assume we want to send a request to the backend when the form is submitted
    // so we add code to send a request in this function
  
    getShopItems(): void {  
       // To send a GET request, use the concept of URL rewriting to pass data to the backend
       // this.http.get<Order>('http://localhost/cs4640/inclass11/ngphp-get.php?str='+params)
       // To send a POST request, pass data as an object
       this.http.post<Array<Item>>('http://localhost/hoos-thrifting/php/item-db.php', 'shop')
       .subscribe((data) => {
            // Receive a response successfully, do something here
            console.log('Response from backend ', data);
            this.responsedata = data;     // assign response to responsedata property to bind to screen later
       }, (error) => {
            // An error occurs, handle an error in some way
            console.log('Error ', error);
       })
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
    }

}
