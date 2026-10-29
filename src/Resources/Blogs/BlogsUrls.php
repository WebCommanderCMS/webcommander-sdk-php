<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs;

final class BlogsUrls
{
    public const BLOGS = '/api/{api_version}/admin/blogs';
    public const BLOGS_COUNT = '/api/{api_version}/admin/blogs/count';
    public const BLOG = '/api/{api_version}/admin/blogs/{blog_id}';
    public const BLOG_COMMENTS = '/api/{api_version}/admin/blogs/{blog_id}/comments';
    public const BLOG_COMMENT = '/api/{api_version}/admin/blogs/{blog_id}/comments/{blog_comment_id}';
    public const BLOG_COMMENT_APPROVE = '/api/{api_version}/admin/blogs/{blog_id}/comments/{blog_comment_id}/approve';
    public const BLOG_COMMENT_MARK_SPAM = '/api/{api_version}/admin/blogs/{blog_id}/comments/{blog_comment_id}/mark-spam';
}
