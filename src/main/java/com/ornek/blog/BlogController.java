package com.ornek.blog;

import org.springframework.data.domain.Sort;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;

@Controller
public class BlogController {
    private final ArticleRepository articles;

    public BlogController(ArticleRepository articles) {
        this.articles = articles;
    }

    @GetMapping("/")
    public String home(Model model) {
        model.addAttribute("articles", articles.findAll(Sort.by(Sort.Direction.DESC, "createdAt")));
        model.addAttribute("blogName", System.getenv().getOrDefault("BLOG_NAME", "Benim Blogum"));
        return "index";
    }

    @GetMapping("/makale/yeni")
    public String newArticle() {
        return "new-article";
    }

    @PostMapping("/makale/yeni")
    public String saveArticle(@RequestParam String title,
                              @RequestParam String content,
                              RedirectAttributes redirect) {
        if (title.isBlank() || content.isBlank()) {
            redirect.addFlashAttribute("error", "Başlık ve makale boş bırakılamaz.");
            return "redirect:/makale/yeni";
        }
        articles.save(new Article(title.trim(), content.trim()));
        redirect.addFlashAttribute("message", "Makale eklendi.");
        return "redirect:/";
    }
}
