package com.ornek.blog;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.PrePersist;
import java.time.LocalDateTime;

@Entity
public class Article {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;
    private String title;
    @jakarta.persistence.Column(length = 10000)
    private String content;
    private LocalDateTime createdAt;

    protected Article() {}

    public Article(String title, String content) {
        this.title = title;
        this.content = content;
    }

    @PrePersist
    void createdNow() {
        createdAt = LocalDateTime.now();
    }

    public Long getId() { return id; }
    public String getTitle() { return title; }
    public String getContent() { return content; }
    public LocalDateTime getCreatedAt() { return createdAt; }
}
