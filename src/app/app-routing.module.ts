import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomeComponent }        from './home/home.component';
import { ShopComponent }        from './shop/shop.component';
import { SellComponent }        from './sell/sell.component';
import { FundraiseComponent }   from './fundraise/fundraise.component';
import { ContactComponent }     from './contact/contact.component';
import { FaqComponent }         from './faq/faq.component';
import { CartdefaultComponent } from './cartdefault/cartdefault.component';
import { CartComponent }        from './cart/cart.component';
import { ProfileComponent }     from './profile/profile.component';
import { PnfComponent }         from './pnf/pnf.component';

const routes: Routes = [ 
    {
        path: 'shop',
        component: ShopComponent,
    },
    {
        path: 'sell',
        component: SellComponent,
    },
    {
        path: 'fundraise',
        component: FundraiseComponent,
    },
    {
        path: 'contact',
        component: ContactComponent,
    },
    {
        path: 'faq',
        component: FaqComponent,
    },
    {
        path: 'cart',
        component: CartdefaultComponent,
    },
    { 
        path: 'cart/:id', 
        component: CartComponent,
    },
    { 
        path: 'profile',
        component: ProfileComponent,
    },
    { 
        path: '',
        component: HomeComponent,
        pathMatch: 'full'
    },
    {
        path: '**',
        component: PnfComponent,
    }];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
