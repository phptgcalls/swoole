<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ReactionCount> results true min true can_see_list true reactions_as_tags Vector<MessagePeerReaction> recent_reactions Vector<MessageReactor> top_reactors
 * @return MessageReactions
 */

final class MessageReactions extends Instance {
	public function request(array $results,? true $min = null,? true $can_see_list = null,? true $reactions_as_tags = null,? array $recent_reactions = null,? array $top_reactors = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa339f0b);
		$flags = 0;
		$flags |= is_null($min) ? 0 : (1 << 0);
		$flags |= is_null($can_see_list) ? 0 : (1 << 2);
		$flags |= is_null($reactions_as_tags) ? 0 : (1 << 3);
		$flags |= is_null($recent_reactions) ? 0 : (1 << 1);
		$flags |= is_null($top_reactors) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->tgwriteVector($results,'ReactionCount');
		if(is_null($recent_reactions) === false):
			$writer->tgwriteVector($recent_reactions,'MessagePeerReaction');
		endif;
		if(is_null($top_reactors) === false):
			$writer->tgwriteVector($top_reactors,'MessageReactor');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['can_see_list'] = true;
		else:
			$result['can_see_list'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['reactions_as_tags'] = true;
		else:
			$result['reactions_as_tags'] = false;
		endif;
		$result['results'] = $reader->tgreadVector('ReactionCount');
		if($flags & (1 << 1)):
			$result['recent_reactions'] = $reader->tgreadVector('MessagePeerReaction');
		else:
			$result['recent_reactions'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['top_reactors'] = $reader->tgreadVector('MessageReactor');
		else:
			$result['top_reactors'] = null;
		endif;
		return new self($result);
	}
}

?>