<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param statsdaterangedays period statsabsvalueandprev followers statsabsvalueandprev views_per_post statsabsvalueandprev shares_per_post statsabsvalueandprev reactions_per_post statsabsvalueandprev views_per_story statsabsvalueandprev shares_per_story statsabsvalueandprev reactions_per_story statspercentvalue enabled_notifications statsgraph growth_graph statsgraph followers_graph statsgraph mute_graph statsgraph top_hours_graph statsgraph interactions_graph statsgraph iv_interactions_graph statsgraph views_by_source_graph statsgraph new_followers_by_source_graph statsgraph languages_graph statsgraph reactions_by_emotion_graph statsgraph story_interactions_graph statsgraph story_reactions_by_emotion_graph Vector<PostInteractionCounters> recent_posts_interactions
 * @return stats.BroadcastStats
 */

final class BroadcastStats extends Instance {
	public function request(object $period,object $followers,object $views_per_post,object $shares_per_post,object $reactions_per_post,object $views_per_story,object $shares_per_story,object $reactions_per_story,object $enabled_notifications,object $growth_graph,object $followers_graph,object $mute_graph,object $top_hours_graph,object $interactions_graph,object $iv_interactions_graph,object $views_by_source_graph,object $new_followers_by_source_graph,object $languages_graph,object $reactions_by_emotion_graph,object $story_interactions_graph,object $story_reactions_by_emotion_graph,array $recent_posts_interactions) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x396ca5fc);
		$writer->write($period->read());
		$writer->write($followers->read());
		$writer->write($views_per_post->read());
		$writer->write($shares_per_post->read());
		$writer->write($reactions_per_post->read());
		$writer->write($views_per_story->read());
		$writer->write($shares_per_story->read());
		$writer->write($reactions_per_story->read());
		$writer->write($enabled_notifications->read());
		$writer->write($growth_graph->read());
		$writer->write($followers_graph->read());
		$writer->write($mute_graph->read());
		$writer->write($top_hours_graph->read());
		$writer->write($interactions_graph->read());
		$writer->write($iv_interactions_graph->read());
		$writer->write($views_by_source_graph->read());
		$writer->write($new_followers_by_source_graph->read());
		$writer->write($languages_graph->read());
		$writer->write($reactions_by_emotion_graph->read());
		$writer->write($story_interactions_graph->read());
		$writer->write($story_reactions_by_emotion_graph->read());
		$writer->tgwriteVector($recent_posts_interactions,'PostInteractionCounters');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['period'] = $reader->tgreadObject();
		$result['followers'] = $reader->tgreadObject();
		$result['views_per_post'] = $reader->tgreadObject();
		$result['shares_per_post'] = $reader->tgreadObject();
		$result['reactions_per_post'] = $reader->tgreadObject();
		$result['views_per_story'] = $reader->tgreadObject();
		$result['shares_per_story'] = $reader->tgreadObject();
		$result['reactions_per_story'] = $reader->tgreadObject();
		$result['enabled_notifications'] = $reader->tgreadObject();
		$result['growth_graph'] = $reader->tgreadObject();
		$result['followers_graph'] = $reader->tgreadObject();
		$result['mute_graph'] = $reader->tgreadObject();
		$result['top_hours_graph'] = $reader->tgreadObject();
		$result['interactions_graph'] = $reader->tgreadObject();
		$result['iv_interactions_graph'] = $reader->tgreadObject();
		$result['views_by_source_graph'] = $reader->tgreadObject();
		$result['new_followers_by_source_graph'] = $reader->tgreadObject();
		$result['languages_graph'] = $reader->tgreadObject();
		$result['reactions_by_emotion_graph'] = $reader->tgreadObject();
		$result['story_interactions_graph'] = $reader->tgreadObject();
		$result['story_reactions_by_emotion_graph'] = $reader->tgreadObject();
		$result['recent_posts_interactions'] = $reader->tgreadVector('PostInteractionCounters');
		return new self($result);
	}
}

?>