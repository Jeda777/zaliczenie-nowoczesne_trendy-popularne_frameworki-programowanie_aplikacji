import { ChangeDetectorRef, Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { ApiService } from './services/api-service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  standalone: false,
  styleUrl: './app.component.scss',
})
export class AppComponent implements OnInit {
  protected title = 'app';

  username?: string;
  message?: string;
  form: any;
  messages: any[] = [];

  constructor(
    private fb: FormBuilder,
    private apiService: ApiService,
    private cdRef: ChangeDetectorRef
  ) {}

  ngOnInit(): void {
    this.form = this.fb.group({
      username: ['', [Validators.required]],
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
    this.apiService
      .createMessage(this.form.value.username, this.form.value.message)
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
