import { ChangeDetectorRef, Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ApiService } from '../services/api-service';
import { Auth } from '../services/auth';

@Component({
  selector: 'app-home',
  templateUrl: './home.html',
  standalone: false,
  styleUrl: './home.scss',
})
export class Home implements OnInit {
  protected title = 'app';
  form: any;
  messages: any[] = [];

  constructor(
    private fb: FormBuilder,
    private apiService: ApiService,
    private cdRef: ChangeDetectorRef,
    private auth: Auth
  ) {}

  ngOnInit(): void {
    this.form = this.fb.group({
      message: ['', [Validators.required]],
    });

    this.apiService.getMessages().subscribe(
      (res) => {
        this.messages = res;
        this.cdRef.detectChanges();
      },
      (err) => {
        console.log(err);
      }
    );
  }

  submitForm() {
    if (!this.form.valid) return;
    const userId = this.auth.getAuthData();
    if (userId == null) return;
    this.apiService
      .createMessage(userId.toString(), this.form.value.message)
      .subscribe(
        (res) => {
          this.messages.push((res as any).message);
          this.cdRef.detectChanges();
        },
        (err) => {
          console.log(err);
        }
      );
    this.form.reset();
  }
}
