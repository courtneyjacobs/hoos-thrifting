import { Component, OnInit } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import {Item} from '../item';

@Component({
  selector: 'app-sell',
  templateUrl: './sell.component.html',
  styleUrls: ['./sell.component.css']
})
export class SellComponent implements OnInit {
    title='Sell';
    url='sell';
    constructor(private http: HttpClient) {   }

    // Let's create a property to store a response from the back end
    // and try binding it back to the view
    // new Item
    responsedata = new Item(0, 'response', '', '', '', '', '','','', 0);

    // used for ngfor
    categories = ['Tops', 'Bottoms', 'Shoes', 'Accessories', 'Other'];
    itemModel = new Item(0, '', '', '', '', '', '','','', 0);
  
  
    confirm_msg = '';
    data_submitted = '';
  
    // Assume we want to send a request to the backend when the form is submitted
    // so we add code to send a request in this function
  
    onSubmit(form: any): void {
       console.log('You submitted value: ', form);
       this.data_submitted = form;
  
       // Convert the form data to json format
       let params = JSON.stringify(form);
  
       // To send a GET request, use the concept of URL rewriting to pass data to the backend
       // this.http.get<Order>('http://localhost/cs4640/inclass11/ngphp-get.php?str='+params)
       // To send a POST request, pass data as an object
       this.http.post<Item>('http://localhost/hoos-thrifting/php/item-db.php', params)
       .subscribe((data) => {
            // Receive a response successfully, do something here
            console.log('Response from backend ', data);
            this.responsedata = data;     // assign response to responsedata property to bind to screen later
       }, (error) => {
            // An error occurs, handle an error in some way
            console.log('Error ', error);
       })
    }
  

    ngOnInit(): void {


    }

}
