<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param statsdaterangedays period statsabsvalueandprev members statsabsvalueandprev messages statsabsvalueandprev viewers statsabsvalueandprev posters statsgraph growth_graph statsgraph members_graph statsgraph new_members_by_source_graph statsgraph languages_graph statsgraph messages_graph statsgraph actions_graph statsgraph top_hours_graph statsgraph weekdays_graph Vector<StatsGroupTopPoster> top_posters Vector<StatsGroupTopAdmin> top_admins Vector<StatsGroupTopInviter> top_inviters Vector<User> users
 * @return stats.MegagroupStats
 */

final class MegagroupStats extends Instance {
	public function request(object $period,object $members,object $messages,object $viewers,object $posters,object $growth_graph,object $members_graph,object $new_members_by_source_graph,object $languages_graph,object $messages_graph,object $actions_graph,object $top_hours_graph,object $weekdays_graph,array $top_posters,array $top_admins,array $top_inviters,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xef7ff916);
		$writer->write($period->read());
		$writer->write($members->read());
		$writer->write($messages->read());
		$writer->write($viewers->read());
		$writer->write($posters->read());
		$writer->write($growth_graph->read());
		$writer->write($members_graph->read());
		$writer->write($new_members_by_source_graph->read());
		$writer->write($languages_graph->read());
		$writer->write($messages_graph->read());
		$writer->write($actions_graph->read());
		$writer->write($top_hours_graph->read());
		$writer->write($weekdays_graph->read());
		$writer->tgwriteVector($top_posters,'StatsGroupTopPoster');
		$writer->tgwriteVector($top_admins,'StatsGroupTopAdmin');
		$writer->tgwriteVector($top_inviters,'StatsGroupTopInviter');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['period'] = $reader->tgreadObject();
		$result['members'] = $reader->tgreadObject();
		$result['messages'] = $reader->tgreadObject();
		$result['viewers'] = $reader->tgreadObject();
		$result['posters'] = $reader->tgreadObject();
		$result['growth_graph'] = $reader->tgreadObject();
		$result['members_graph'] = $reader->tgreadObject();
		$result['new_members_by_source_graph'] = $reader->tgreadObject();
		$result['languages_graph'] = $reader->tgreadObject();
		$result['messages_graph'] = $reader->tgreadObject();
		$result['actions_graph'] = $reader->tgreadObject();
		$result['top_hours_graph'] = $reader->tgreadObject();
		$result['weekdays_graph'] = $reader->tgreadObject();
		$result['top_posters'] = $reader->tgreadVector('StatsGroupTopPoster');
		$result['top_admins'] = $reader->tgreadVector('StatsGroupTopAdmin');
		$result['top_inviters'] = $reader->tgreadVector('StatsGroupTopInviter');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>