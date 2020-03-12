import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { HomeComponent }        from './home/home.component';
import { ShopComponent }        from './shop/shop.component';
import { SellComponent }        from './sell/sell.component';
import { FundraiseComponent }   from './fundraise/fundraise.component';
import { ContactComponent }     from './contact/contact.component';
import { FaqComponent }         from './faq/faq.component';
import { CartComponent }        from './cart/cart.component';
import { ProfileComponent }     from './profile/profile.component';
import { PnfComponent }         from './pnf/pnf.component';

const routes: Routes = [ 
    {
        path: 'shop',
        component: ShopComponent,
        data: { title: 'Shop' }
    },
    {
        path: 'sell',
        component: SellComponent,
        data: { title: 'Sell' }
    },
    {
        path: 'fundraise',
        component: FundraiseComponent,
        data: { title: 'Fundraise' }
    },
    {
        path: 'contact',
        component: ContactComponent,
        data: { title: 'Contact Us' }
    },
    {
        path: 'faq',
        component: FaqComponent,
        data: { title: 'Frequently Asked Questions' }
    },
    { 
        path: 'cart/:id', 
        component: CartComponent,
        data: { title: 'Cart' }
    },
    { 
        path: 'profile/:id',
        component: ProfileComponent,
        data: { title: 'Profile' }
    },
    { 
        path: '',
        component: HomeComponent,
        pathMatch: 'full'
    },
    {
        path: '**',
        component: PnfComponent,
        data: { title: 'Page Not Found'}
    }];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
