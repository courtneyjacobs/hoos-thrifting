import { Injectable } from '@angular/core';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';

import { Item } from './item';


@Injectable({
  providedIn: 'root'
})
export class ItemService {

  constructor(private http: HttpClient) { }

  sendRequest(func: any): Observable<any> {
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'text'});
    // return this.http.post('http://localhost/cs4640/inclass11/ngphp-post.php', data, {responseType: 'json'});
    return this.http.post('http://localhost/hoos-thrifting/php/item-db.php', func);
  }

  getItem(func): Observable<Item[]> {
     return this.sendRequest(func);
  }
}
