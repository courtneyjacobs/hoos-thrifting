import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

// NEEDED TO USE HTTP AND FORMS
import { HttpClientModule } from '@angular/common/http';
import {FormsModule} from '@angular/forms';

import { ItemService } from './item.service'

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

// base href from https://stackoverflow.com/questions/34535163/angular-2-router-no-base-href-set
import {APP_BASE_HREF} from '@angular/common';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    ItemService,
    {provide: APP_BASE_HREF, useValue : '/' }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
