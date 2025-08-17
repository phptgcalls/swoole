<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int date int source true muted true left true can_self_unmute true just_joined true versioned true min true muted_by_you true volume_by_admin true self true video_joined int active_date int volume string about long raise_hand_rating groupcallparticipantvideo video groupcallparticipantvideo presentation
 * @return GroupCallParticipant
 */

final class GroupCallParticipant extends Instance {
	public function request(object $peer,int $date,int $source,? true $muted = null,? true $left = null,? true $can_self_unmute = null,? true $just_joined = null,? true $versioned = null,? true $min = null,? true $muted_by_you = null,? true $volume_by_admin = null,? true $self = null,? true $video_joined = null,? int $active_date = null,? int $volume = null,? string $about = null,? int $raise_hand_rating = null,? object $video = null,? object $presentation = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeba636fe);
		$flags = 0;
		$flags |= is_null($muted) ? 0 : (1 << 0);
		$flags |= is_null($left) ? 0 : (1 << 1);
		$flags |= is_null($can_self_unmute) ? 0 : (1 << 2);
		$flags |= is_null($just_joined) ? 0 : (1 << 4);
		$flags |= is_null($versioned) ? 0 : (1 << 5);
		$flags |= is_null($min) ? 0 : (1 << 8);
		$flags |= is_null($muted_by_you) ? 0 : (1 << 9);
		$flags |= is_null($volume_by_admin) ? 0 : (1 << 10);
		$flags |= is_null($self) ? 0 : (1 << 12);
		$flags |= is_null($video_joined) ? 0 : (1 << 15);
		$flags |= is_null($active_date) ? 0 : (1 << 3);
		$flags |= is_null($volume) ? 0 : (1 << 7);
		$flags |= is_null($about) ? 0 : (1 << 11);
		$flags |= is_null($raise_hand_rating) ? 0 : (1 << 13);
		$flags |= is_null($video) ? 0 : (1 << 6);
		$flags |= is_null($presentation) ? 0 : (1 << 14);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($date);
		if(is_null($active_date) === false):
			$writer->writeInt($active_date);
		endif;
		$writer->writeInt($source);
		if(is_null($volume) === false):
			$writer->writeInt($volume);
		endif;
		if(is_null($about) === false):
			$writer->tgwriteBytes($about);
		endif;
		if(is_null($raise_hand_rating) === false):
			$writer->writeLong($raise_hand_rating);
		endif;
		if(is_null($video) === false):
			$writer->write($video->read());
		endif;
		if(is_null($presentation) === false):
			$writer->write($presentation->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['muted'] = true;
		else:
			$result['muted'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['left'] = true;
		else:
			$result['left'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['can_self_unmute'] = true;
		else:
			$result['can_self_unmute'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['just_joined'] = true;
		else:
			$result['just_joined'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['versioned'] = true;
		else:
			$result['versioned'] = false;
		endif;
		if($flags & (1 << 8)):
			$result['min'] = true;
		else:
			$result['min'] = false;
		endif;
		if($flags & (1 << 9)):
			$result['muted_by_you'] = true;
		else:
			$result['muted_by_you'] = false;
		endif;
		if($flags & (1 << 10)):
			$result['volume_by_admin'] = true;
		else:
			$result['volume_by_admin'] = false;
		endif;
		if($flags & (1 << 12)):
			$result['self'] = true;
		else:
			$result['self'] = false;
		endif;
		if($flags & (1 << 15)):
			$result['video_joined'] = true;
		else:
			$result['video_joined'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['active_date'] = $reader->readInt();
		else:
			$result['active_date'] = null;
		endif;
		$result['source'] = $reader->readInt();
		if($flags & (1 << 7)):
			$result['volume'] = $reader->readInt();
		else:
			$result['volume'] = null;
		endif;
		if($flags & (1 << 11)):
			$result['about'] = $reader->tgreadBytes();
		else:
			$result['about'] = null;
		endif;
		if($flags & (1 << 13)):
			$result['raise_hand_rating'] = $reader->readLong();
		else:
			$result['raise_hand_rating'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['video'] = $reader->tgreadObject();
		else:
			$result['video'] = null;
		endif;
		if($flags & (1 << 14)):
			$result['presentation'] = $reader->tgreadObject();
		else:
			$result['presentation'] = null;
		endif;
		return new self($result);
	}
}

?>