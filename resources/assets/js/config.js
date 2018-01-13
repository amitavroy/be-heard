export const apiDomain = window.Laravel.basePath;

export const saveConversationUrl = apiDomain + 'api/conversations/save';
export const saveConversationReplyUrl = apiDomain + 'api/conversation/reply/save';
export const getCommentById = apiDomain + 'api/comment/get';
export const updateCommentById = apiDomain + 'api/comment/update';