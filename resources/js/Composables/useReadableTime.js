
export function useReadableTime () {
    function readableTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

        if (diffMins < 60) {
            return (diffMins + " minutes ago");
        } else if (diffHours < 24) {
            return (diffHours + " hours ago");
        } else {
            return (diffDays + " days ago");
        }
    }
    return { readableTime };
}
