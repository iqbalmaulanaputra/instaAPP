let currentGroupIndex = 0;
let currentStoryIndex = 0;
let storyTimer = null;
const STORY_DURATION = 5000;

function openStoryViewer(userId) {
    const groups = window.storyGroups || [];
    const idx = groups.findIndex((g) => g.userId === String(userId));
    if (idx === -1) return;

    currentGroupIndex = idx;
    currentStoryIndex = 0;
    openModal("storyViewerModal");
    renderStory();
}

function renderStory() {
    clearTimeout(storyTimer);

    const groups = window.storyGroups || [];
    const group = groups[currentGroupIndex];
    if (!group) {
        closeStoryViewer();
        return;
    }

    const story = group.stories[currentStoryIndex];
    if (!story) {
        goToGroup(currentGroupIndex + 1);
        return;
    }

    document.getElementById("storyViewerImage").src = story.image;
    document.getElementById("storyViewerUsername").textContent =
        "@" + group.username;

    renderProgressBars(group.stories.length, currentStoryIndex);

    if (group.userId !== "own") {
        api.post(`/story/${story.id}/view`);
    }

    storyTimer = setTimeout(() => nextStory(), STORY_DURATION);
}

function renderProgressBars(total, activeIndex) {
    const container = document.getElementById("storyProgressBars");
    container.innerHTML = "";

    for (let i = 0; i < total; i++) {
        const bar = document.createElement("div");
        bar.className = "flex-1 h-1 rounded-full bg-white/30 overflow-hidden";

        const fill = document.createElement("div");
        fill.className = "h-full bg-white";
        fill.style.width = i < activeIndex ? "100%" : "0%";

        if (i === activeIndex) {
            fill.style.transition = `width ${STORY_DURATION}ms linear`;
            requestAnimationFrame(() => {
                fill.style.width = "100%";
            });
        }

        bar.appendChild(fill);
        container.appendChild(bar);
    }
}

function nextStory() {
    currentStoryIndex++;
    const group = (window.storyGroups || [])[currentGroupIndex];

    if (!group || currentStoryIndex >= group.stories.length) {
        goToGroup(currentGroupIndex + 1);
        return;
    }

    renderStory();
}

function prevStory() {
    if (currentStoryIndex > 0) {
        currentStoryIndex--;
        renderStory();
        return;
    }

    goToGroup(currentGroupIndex - 1, true);
}

function goToGroup(index, toLastStory = false) {
    const groups = window.storyGroups || [];

    if (index < 0 || index >= groups.length) {
        closeStoryViewer();
        return;
    }

    currentGroupIndex = index;
    currentStoryIndex = toLastStory ? groups[index].stories.length - 1 : 0;
    renderStory();
}

function closeStoryViewer() {
    clearTimeout(storyTimer);
    closeModal("storyViewerModal");
}

window.openStoryViewer = openStoryViewer;
window.nextStory = nextStory;
window.prevStory = prevStory;
window.closeStoryViewer = closeStoryViewer;
