import { RouterModule, Routes } from '@angular/router';
import { GuardGuard } from './guards/guard-guard';
import { AppComponent } from './app.component';
import { Login } from './login/login';
import { NgModule } from '@angular/core';
import { Home } from './home/home';

const routes: Routes = [
  { path: '', canActivate: [GuardGuard], component: Home },
  { path: 'auth', component: Login },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
