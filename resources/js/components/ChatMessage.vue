<template>
  <div class="chat-container">
    <!-- Sidebar - User Chat List -->
    <div class="sidebar">
      <div class="sidebar-header">
        <div class="header-content">
          <div class="chat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2Z" fill="currentColor"/>
            </svg>
          </div>
          <h2 class="chat-title">Chat List</h2>
        </div>
        <div class="online-indicator">
          <span class="online-dot"></span>
          <span class="online-text">Online</span>
        </div>
      </div>

      <div class="user-search">
        <div class="search-container">
          <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none">
            <circle cx="11" cy="11" r="8" stroke="currentColor" stroke-width="2"/>
            <path d="m21 21-4.35-4.35" stroke="currentColor" stroke-width="2"/>
          </svg>
          <input type="text" placeholder="Search conversations..." class="search-input">
        </div>
      </div>

      <div class="user-list">
        <div
          v-for="(user, index) in filteredUsers"
          :key="index"
          class="user-item"
          :class="{ 'active': selectedUser === user.id }"
          @click="userMessage(user.id)"
        >
          <div class="user-avatar-container">
            <img
              :src="user.role === 'user' ? '/upload/user_images/' + user.photo : '/upload/instructor_images/' + user.photo"
              alt="UserImage"
              class="user-avatar"
            />
            <div class="status-indicator" :class="user.online ? 'online' : 'offline'"></div>
          </div>
          <div class="user-info">
            <span class="username">{{ user.name }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Chat Area -->
    <div class="chat-main" v-if="allmessages.user">
      <!-- Chat Header -->
      <div class="chat-header">
        <div class="chat-user-info">
          <img
            :src="allmessages.user.role === 'user' ? '/upload/user_images/' + allmessages.user.photo : '/upload/instructor_images/' + allmessages.user.photo"
            class="header-avatar"
            alt="User Avatar"
          />
          <div class="header-user-details">
            <h3 class="header-username">{{ allmessages.user.name }}</h3>
          </div>
        </div>

        <div class="chat-actions">
          <button class="action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M22 16.92V12C22 6.48 17.52 2 12 2S2 6.48 2 12C2 17.52 6.48 22 12 22H16.92" stroke="currentColor" stroke-width="2"/>
              <path d="M13 2.05S16 6 16 12" stroke="currentColor" stroke-width="2"/>
              <path d="M11 21.95S8 18 8 12" stroke="currentColor" stroke-width="2"/>
              <path d="M2 15H22" stroke="currentColor" stroke-width="2"/>
              <path d="M2 9H22" stroke="currentColor" stroke-width="2"/>
            </svg>
          </button>
          <button class="action-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <circle cx="12" cy="12" r="1" fill="currentColor"/>
              <circle cx="19" cy="12" r="1" fill="currentColor"/>
              <circle cx="5" cy="12" r="1" fill="currentColor"/>
            </svg>
          </button>
        </div>
      </div>

      <!-- Messages Container -->
      <div class="messages-container">
        <div class="messages-wrapper">
          <div
            v-for="(msg, index) in allmessages.messages"
            :key="index"
            :class="['message-group', allmessages.user.id === msg.sender_id ? 'message-sent' : 'message-received']"
          >
            <div class="message-avatar" v-if="allmessages.user.id !== msg.sender_id">
              <img
                :src="msg.user.role === 'user' ? '/upload/user_images/' + msg.user.photo : '/upload/instructor_images/' + msg.user.photo"
                alt="User Avatar"
                class="message-user-img"
              />
            </div>

            <div class="message-content">
              <div class="message-bubble">
                <div class="message-header" v-if="allmessages.user.id !== msg.sender_id">
                  <span class="message-sender">{{ msg.user.name }}</span>
                </div>
                <p class="message-text">{{ msg.msg }}</p>
                <div class="message-footer">
                  <span class="message-time">{{ formatDate(msg.created_at) }}</span>
                  <div v-if="allmessages.user.id === msg.sender_id" class="message-status">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                      <path d="M20 6L9 17L4 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Message Input -->
      <div class="message-input-container">
        <div class="input-wrapper">
          <button class="attachment-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M21.44 11.05L12.25 20.24C11.12 21.37 9.31 21.37 8.18 20.24C7.05 19.11 7.05 17.3 8.18 16.17L16.17 8.18C16.92 7.43 18.08 7.43 18.83 8.18C19.58 8.93 19.58 10.09 18.83 10.84L11.93 17.74" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>

          <div class="text-input-container">
            <input
              id="btn-input"
              type="text"
              v-model="msg"
              class="message-input"
              placeholder="Type your message..."
              @keypress.enter="sendMsg"
            />
            <button class="emoji-btn">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                <path d="M8 14S9.5 16 12 16S16 14 16 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M9 9H9.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M15 9H15.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>

          <button class="send-btn" @click="sendMsg" :disabled="!msg.trim()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
              <path d="M22 2L11 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M22 2L15 22L11 13L2 9L22 2Z" fill="currentColor"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Empty State -->
    <div class="empty-state" v-else>
      <div class="empty-content">
        <div class="empty-icon">
          <svg width="64" height="64" viewBox="0 0 24 24" fill="none">
            <path d="M21 15A2 2 0 0 1 19 17H7L4 20V5A2 2 0 0 1 6 3H19A2 2 0 0 1 21 5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <h3>Welcome to Advanced Chat</h3>
        <p>Select a conversation to start messaging</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      users: [],
      allmessages: {},
      selectedUser: '',
      msg: '',
      currentUserId: null, // Will be set from Laravel auth
    };
  },

  computed: {
    // Filter out current user from chat list - only if currentUserId exists
    filteredUsers() {
      // If no currentUserId set, show all users (for now)
      if (!this.currentUserId) return this.users;
      return this.users.filter(user => user.id !== this.currentUserId);
    }
  },

  created() {
    this.getCurrentUser(); // Get current user info first
    this.getAllUser();

    setInterval(() => {
      this.userMessage(this.selectedUser);
    }, 1000);
  },

  methods: {
    // Get current logged-in user info
    getCurrentUser() {
      // Get current user from Laravel auth or session
      axios
        .get('/auth/user') // Laravel's default auth user endpoint
        .then((res) => {
          this.currentUserId = res.data.id;
        })
        .catch((err) => {
          console.error('Error fetching current user:', err);
          // You can also get from Laravel Blade template:
          // this.currentUserId = {{ auth()->id() }};
        });
    },

    getAllUser() {
      axios
        .get('/user-all')
        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.error('Error fetching users:', err);
        });
    },

    userMessage(userId) {
      axios
        .get('/user-message/' + userId)
        .then((res) => {
          this.allmessages = res.data;
          this.selectedUser = userId;
        })
        .catch((err) => {
          console.error('Error fetching messages:', err);
        });
    },

    sendMsg() {
      if (!this.msg.trim()) return;

      axios
        .post('/send-message', { receiver_id: this.selectedUser, msg: this.msg })
        .then((res) => {
          this.msg = '';
          this.userMessage(this.selectedUser);
        })
        .catch((err) => {
          console.error('Error sending message:', err);
        });
    },

    formatDate(dateString) {
      const options = { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      return new Date(dateString).toLocaleDateString('en-US', options);
    },
  },
};
</script>

<style scoped>
/* Global Styles */
* {
  box-sizing: border-box;
}

.chat-container {
  display: flex;
  height: 100vh;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  background: #f8fafc;
  overflow: hidden;
}

/* Sidebar Styles */
.sidebar {
  width: 380px;
  background: white;
  border-right: 1px solid #e5e7eb;
  display: flex;
  flex-direction: column;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
}

.sidebar-header {
  padding: 24px 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
}

.header-content {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
}

.chat-icon {
  padding: 8px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 12px;
  backdrop-filter: blur(10px);
}

.chat-title {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}

.online-indicator {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 14px;
  opacity: 0.9;
}

.online-dot {
  width: 8px;
  height: 8px;
  background: #4ade80;
  border-radius: 50%;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.online-text {
  font-size: 13px;
}

.user-search {
  padding: 16px 20px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.search-container {
  position: relative;
  display: flex;
  align-items: center;
}

.search-icon {
  position: absolute;
  left: 12px;
  color: #6b7280;
  z-index: 1;
}

.search-input {
  width: 100%;
  padding: 12px 12px 12px 40px;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 20px;
  background: rgba(249, 250, 251, 0.8);
  font-size: 14px;
  transition: all 0.3s ease;
}

.search-input:focus {
  outline: none;
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.user-list {
  flex: 1;
  overflow-y: auto;
  padding: 8px 0;
}

.user-item {
  display: flex;
  align-items: center;
  padding: 16px 20px;
  cursor: pointer;
  transition: all 0.3s ease;
  border-radius: 12px;
  margin: 4px 12px;
  position: relative;
}

.user-item:hover {
  background: rgba(102, 126, 234, 0.08);
  transform: translateX(4px);
}

.user-item.active {
  background: linear-gradient(135deg, rgba(102, 126, 234, 0.15) 0%, rgba(118, 75, 162, 0.15) 100%);
  border-left: 4px solid #667eea;
  transform: translateX(0);
  box-shadow: 0 2px 12px rgba(102, 126, 234, 0.2);
}

.user-avatar-container {
  position: relative;
  margin-right: 12px;
}

.user-avatar {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid rgba(255, 255, 255, 0.9);
  box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
}

.status-indicator {
  position: absolute;
  bottom: 2px;
  right: 2px;
  width: 12px;
  height: 12px;
  border-radius: 50%;
  border: 2px solid white;
}

.status-indicator.online {
  background: #10b981;
}

.status-indicator.offline {
  background: #6b7280;
}

.user-info {
  flex: 1;
  min-width: 0;
}

.username {
  display: block;
  font-weight: 600;
  color: #1f2937;
  font-size: 17px;
  margin-bottom: 0;
  letter-spacing: -0.02em;
}

.user-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  justify-content: center;
}

/* Remove unread badge styles since we removed the element */

/* Main Chat Area */
.chat-main {
  flex: 1;
  display: flex;
  flex-direction: column;
  background: white;
}

.chat-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px 24px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  background: white;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.chat-user-info {
  display: flex;
  align-items: center;
  gap: 12px;
}

.header-avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid rgba(102, 126, 234, 0.2);
}

.header-user-details h3 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  color: #1f2937;
}

.chat-actions {
  display: flex;
  gap: 8px;
}

.action-btn {
  padding: 8px;
  border: none;
  background: rgba(102, 126, 234, 0.1);
  color: #667eea;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
}

.action-btn:hover {
  background: rgba(102, 126, 234, 0.2);
  transform: translateY(-1px);
}

/* Messages Container */
.messages-container {
  flex: 1;
  overflow-y: auto;
  background: #f8fafc;
}

.messages-wrapper {
  padding: 20px 24px;
  max-width: 800px;
  margin: 0 auto;
}

.message-group {
  display: flex;
  margin-bottom: 20px;
  align-items: flex-end;
  gap: 8px;
}

.message-group.message-sent {
  flex-direction: row-reverse;
}

.message-avatar {
  flex-shrink: 0;
}

.message-user-img {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  object-fit: cover;
}

.message-content {
  max-width: 70%;
}

.message-bubble {
  padding: 12px 16px;
  border-radius: 18px;
  position: relative;
  backdrop-filter: blur(10px);
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}

.message-sent .message-bubble {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-bottom-right-radius: 6px;
}

.message-received .message-bubble {
  background: rgba(255, 255, 255, 0.9);
  color: #1f2937;
  border-bottom-left-radius: 6px;
  border: 1px solid rgba(0, 0, 0, 0.05);
}

.message-header {
  margin-bottom: 4px;
}

.message-sender {
  font-size: 13px;
  font-weight: 600;
  color: #667eea;
}

.message-text {
  margin: 0;
  line-height: 1.5;
  font-size: 14px;
  word-wrap: break-word;
}

.message-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 6px;
}

.message-time {
  font-size: 11px;
  opacity: 0.7;
}

.message-sent .message-time {
  color: rgba(255, 255, 255, 0.8);
}

.message-received .message-time {
  color: #6b7280;
}

.message-status svg {
  color: rgba(255, 255, 255, 0.8);
}

/* Message Input */
.message-input-container {
  padding: 16px 24px;
  background: white;
  border-top: 1px solid rgba(0, 0, 0, 0.05);
}

.input-wrapper {
  display: flex;
  align-items: center;
  gap: 12px;
  max-width: 800px;
  margin: 0 auto;
}

.attachment-btn {
  padding: 10px;
  border: none;
  background: rgba(102, 126, 234, 0.1);
  color: #667eea;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;
  flex-shrink: 0;
}

.attachment-btn:hover {
  background: rgba(102, 126, 234, 0.2);
  transform: rotate(15deg);
}

.text-input-container {
  flex: 1;
  position: relative;
  display: flex;
  align-items: center;
  background: rgba(249, 250, 251, 0.8);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 24px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.text-input-container:focus-within {
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  background: white;
}

.message-input {
  flex: 1;
  padding: 12px 16px;
  border: none;
  outline: none;
  background: transparent;
  font-size: 14px;
  color: #1f2937;
}

.message-input::placeholder {
  color: #9ca3af;
}

.emoji-btn {
  padding: 8px;
  border: none;
  background: transparent;
  color: #9ca3af;
  cursor: pointer;
  border-radius: 50%;
  margin-right: 8px;
  transition: all 0.3s ease;
}

.emoji-btn:hover {
  color: #667eea;
  background: rgba(102, 126, 234, 0.1);
}

.send-btn {
  padding: 10px;
  border: none;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border-radius: 50%;
  cursor: pointer;
  transition: all 0.3s ease;
  flex-shrink: 0;
  box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.send-btn:hover:not(:disabled) {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.send-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

/* Empty State */
.empty-state {
  flex: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
}

.empty-content {
  text-align: center;
  color: #6b7280;
}

.empty-icon {
  margin-bottom: 20px;
  opacity: 0.6;
}

.empty-content h3 {
  margin-bottom: 8px;
  color: #374151;
  font-weight: 600;
}

.empty-content p {
  margin: 0;
  font-size: 14px;
}

/* Scrollbar Styling */
::-webkit-scrollbar {
  width: 6px;
}

::-webkit-scrollbar-track {
  background: transparent;
}

::-webkit-scrollbar-thumb {
  background: rgba(0, 0, 0, 0.2);
  border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
  background: rgba(0, 0, 0, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
  .sidebar {
    width: 100%;
    position: absolute;
    z-index: 10;
    height: 100vh;
  }

  .chat-main {
    width: 100%;
  }

  .messages-wrapper {
    padding: 20px 16px;
  }

  .message-input-container {
    padding: 16px;
  }
}
</style>
