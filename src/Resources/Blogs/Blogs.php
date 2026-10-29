<?php

declare(strict_types=1);

namespace WebCommander\Resources\Blogs;

use WebCommander\Client\ApiResponse;
use WebCommander\Client\Dto;
use WebCommander\Client\WebCommanderClient;
use WebCommander\Resources\Blogs\BlogsDto\Blog;
use WebCommander\Resources\Blogs\BlogsDto\BlogCommentEnvelope;
use WebCommander\Resources\Blogs\BlogsDto\BlogCommentList;
use WebCommander\Resources\Blogs\BlogsDto\BlogCount;
use WebCommander\Resources\Blogs\BlogsDto\BlogPage;

/** Blog and blog comment endpoints, under `/api/{api_version}/admin`. */
final class Blogs
{
    /** List the blogs, latest `date` first - `GET /admin/blogs`. `limit` is capped at 20; `ids`,
     *  `category` and `visibility` filter, and an unknown name is `400`.
     *  @param array<string,mixed>|null $queryParams */
    public static function listBlogs(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogsUrls::BLOGS, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogPage::class);
    }

    /** How many blogs are live - `GET /admin/blogs/count`, `{"blogs": {"count": N}}`, narrowed by
     *  the listing's filters and not by its paging.
     *  @param array<string,mixed>|null $queryParams */
    public static function countBlogs(WebCommanderClient $client, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogsUrls::BLOGS_COUNT, queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCount::class);
    }

    /** Create a blog - `POST /admin/blogs`, `201`. The body is `{"blog": {...}}` with `title`
     *  required, unique among live and trashed blogs alike.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createBlog(WebCommanderClient $client, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(BlogsUrls::BLOGS, jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Blog::class);
    }

    /** Retrieve one blog - `GET /admin/blogs/{blog_id}`; `field_metadata=true` adds the field
     *  schema beside it, and a trashed blog is `404`.
     *  @param array<string,mixed>|null $queryParams */
    public static function getBlog(WebCommanderClient $client, int|string $blogId, ?array $queryParams = null, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogsUrls::BLOG, pathParams: ['blog_id' => $blogId], queryParams: $queryParams, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Blog::class);
    }

    /** Replace one blog - `PUT /admin/blogs/{blog_id}`. `title` and `visibility` are required;
     *  every other field left out is reset, except the image and `url`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function updateBlog(WebCommanderClient $client, int|string $blogId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPutRequest(BlogsUrls::BLOG, pathParams: ['blog_id' => $blogId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Blog::class);
    }

    /** Change only the fields sent - `PATCH /admin/blogs/{blog_id}`, in the `blog` wrapper; the
     *  answer carries `group_meta` beside the row.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function patchBlog(WebCommanderClient $client, int|string $blogId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPatchRequest(BlogsUrls::BLOG, pathParams: ['blog_id' => $blogId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: Blog::class);
    }

    /** Move one blog to the trash - `DELETE /admin/blogs/{blog_id}`, `204`. Its title stays taken,
     *  and its comments stay readable. */
    public static function deleteBlog(WebCommanderClient $client, int|string $blogId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendDeleteRequest(BlogsUrls::BLOG, pathParams: ['blog_id' => $blogId], raiseOnError: $raiseOnError, responseFormat: $responseFormat);
    }

    /** Every comment on one blog, oldest first and unpaged - `GET /admin/blogs/{blog_id}/comments`;
     *  no query parameter has an effect. */
    public static function listBlogComments(WebCommanderClient $client, int|string $blogId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogsUrls::BLOG_COMMENTS, pathParams: ['blog_id' => $blogId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCommentList::class);
    }

    /** Add a comment, `pending` - `POST /admin/blogs/{blog_id}/comments`, `201`. The body is
     *  `{"blog": {"comment": {...}}}`; without that wrapper it is `404`.
     *  @param array<string,mixed>|string|Dto $payload */
    public static function createBlogComment(WebCommanderClient $client, int|string $blogId, array|string|Dto $payload, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(BlogsUrls::BLOG_COMMENTS, pathParams: ['blog_id' => $blogId], jsonBody: $payload, raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCommentEnvelope::class);
    }

    /** Retrieve one comment - `GET /admin/blogs/{blog_id}/comments/{blog_comment_id}`; the
     *  top-level `id` is the blog's, the comment's is inside. */
    public static function getBlogComment(WebCommanderClient $client, int|string $blogId, int|string $blogCommentId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendGetRequest(BlogsUrls::BLOG_COMMENT, pathParams: ['blog_id' => $blogId, 'blog_comment_id' => $blogCommentId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCommentEnvelope::class);
    }

    /** Approve one comment - `POST /admin/blogs/{blog_id}/comments/{blog_comment_id}/approve`, no
     *  body, `201`; `spam` is left as it was. */
    public static function approveBlogComment(WebCommanderClient $client, int|string $blogId, int|string $blogCommentId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(BlogsUrls::BLOG_COMMENT_APPROVE, pathParams: ['blog_id' => $blogId, 'blog_comment_id' => $blogCommentId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCommentEnvelope::class);
    }

    /** Mark one comment as spam, setting `status` and `spam` -
     *  `POST /admin/blogs/{blog_id}/comments/{blog_comment_id}/mark-spam`, no body, `201`. */
    public static function markBlogCommentSpam(WebCommanderClient $client, int|string $blogId, int|string $blogCommentId, ?bool $raiseOnError = null, ?string $responseFormat = null): ApiResponse
    {
        return $client->sendPostRequest(BlogsUrls::BLOG_COMMENT_MARK_SPAM, pathParams: ['blog_id' => $blogId, 'blog_comment_id' => $blogCommentId], raiseOnError: $raiseOnError, responseFormat: $responseFormat, dtoType: BlogCommentEnvelope::class);
    }
}
